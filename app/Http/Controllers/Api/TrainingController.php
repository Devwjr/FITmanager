<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\TrainingSession;
use App\Models\User;
use App\Models\Workout;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TrainingController extends Controller
{
    public function exercises()
    {
        return Exercise::orderBy('name')->get();
    }

    public function saveExercise(Request $r, ?Exercise $exercise = null)
    {
        $data = $r->validate(['name' => 'required|string|max:150', 'muscle_group' => 'required|string|max:100', 'instructions' => 'nullable|string|max:5000']);
        $exercise = $exercise ?? new Exercise;
        $exercise->fill($data)->save();

        return $exercise;
    }

    public function students()
    {
        return User::where('is_admin', false)->orderBy('name')->get(['id', 'name']);
    }

    public function workouts(User $user)
    {
        return Workout::where('user_id', $user->id)->latest()->get();
    }

    private function items(Request $r, array $extra)
    {
        $data = $r->validate(array_merge($extra, [
            'notes' => 'nullable|string|max:5000', 'items' => 'required|array|min:1|max:100',
            'items.*.exercise_id' => ['required', 'integer', Rule::exists('exercises', 'id')],
            'items.*.sets' => 'required|integer|min:1|max:100', 'items.*.reps' => 'required|integer|min:1|max:1000',
            'items.*.weight' => 'required|numeric|min:0|max:2000',
        ]));
        $data['items'] = array_map(function ($item) {
            $exercise = Exercise::findOrFail($item['exercise_id']);

            return ['exercise_id' => $exercise->id, 'name' => $exercise->name, 'muscle_group' => $exercise->muscle_group,
                'sets' => (int) $item['sets'], 'reps' => (int) $item['reps'], 'weight' => (float) $item['weight']];
        }, $data['items']);

        return $data;
    }

    public function saveWorkout(Request $r, User $user, ?Workout $workout = null)
    {
        abort_if($user->is_admin, 422, 'Selecione um aluno.');
        if ($workout) {
            abort_unless($workout->user_id === $user->id, 404);
        }
        $data = $this->items($r, ['name' => 'required|string|max:150', 'days_per_week' => 'required|integer|min:1|max:7']);
        $workout = $workout ?? new Workout;
        $workout->fill($data + ['user_id' => $user->id])->save();

        return $workout;
    }

    public function deleteWorkout(User $user, Workout $workout)
    {
        abort_unless($workout->user_id === $user->id, 404);
        $workout->delete();

        return response()->noContent();
    }

    public function saveSession(Request $r, User $user)
    {
        abort_if($user->is_admin, 422, 'Selecione um aluno.');

        return TrainingSession::create($this->items($r, ['performed_on' => 'required|date_format:Y-m-d|before_or_equal:today']) + ['user_id' => $user->id]);
    }

    public function deleteSession(User $user, TrainingSession $session)
    {
        abort_unless($session->user_id === $user->id, 404);
        $session->delete();

        return response()->noContent();
    }

    private function totals($sessions)
    {
        $result = ['sessions' => $sessions->count(), 'sets' => 0, 'reps' => 0, 'volume' => 0, 'muscles' => []];
        foreach ($sessions as $session) {
            foreach ($session->items as $item) {
                $sets = $item['sets'];
                $reps = $sets * $item['reps'];
                $volume = $reps * $item['weight'];
                $result['sets'] += $sets;
                $result['reps'] += $reps;
                $result['volume'] += $volume;
                $group = $item['muscle_group'];
                $result['muscles'][$group] = ($result['muscles'][$group] ?? 0) + $sets;
            }
        }
        $result['volume'] = round($result['volume'], 2);

        return $result;
    }

    public function progress(Request $r, User $user)
    {
        $data = $r->validate(['period' => 'required|in:week,month', 'date' => 'required|date_format:Y-m-d']);
        $date = CarbonImmutable::parse($data['date']);
        $start = $data['period'] === 'week' ? $date->startOfWeek() : $date->startOfMonth();
        $end = $data['period'] === 'week' ? $start->addWeek() : $start->addMonth();
        $previous = $data['period'] === 'week' ? $start->subWeek() : $start->subMonth();
        $query = fn ($from, $to) => TrainingSession::where('user_id', $user->id)->where('performed_on', '>=', $from->toDateString())->where('performed_on', '<', $to->toDateString())->orderByDesc('performed_on')->orderByDesc('id')->get();
        $sessions = $query($start, $end);
        $current = $this->totals($sessions);
        $past = $this->totals($query($previous, $start));
        $changes = [];
        foreach (['sessions', 'sets', 'reps', 'volume'] as $metric) {
            $changes[$metric] = $past[$metric] > 0 ? round(($current[$metric] - $past[$metric]) / $past[$metric] * 100, 1) : null;
        }

        return ['start' => $start->toDateString(), 'end' => $end->subDay()->toDateString(), 'previous_start' => $previous->toDateString(), 'previous_end' => $start->subDay()->toDateString(), 'current' => $current, 'previous' => $past, 'changes' => $changes, 'sessions' => $sessions];
    }
}
