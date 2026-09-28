<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrainingTest extends TestCase
{
    use RefreshDatabase;

    private function admin()
    {
        $this->seed(AdminSeeder::class);

        return User::where('username', 'edu')->firstOrFail();
    }

    public function test_admin_login_and_seed_does_not_reset_password()
    {
        $admin = $this->admin();
        $this->postJson('/api/auth/login', ['email' => 'edu', 'password' => 'edu12345'])->assertOk()->assertJsonPath('user.is_admin', true);
        $this->postJson('/api/auth/login', ['email' => 'edu', 'password' => 'wrong'])->assertUnauthorized();
        $admin->update(['password' => bcrypt('changed123')]);
        $this->seed(AdminSeeder::class);
        $this->postJson('/api/auth/login', ['email' => 'edu', 'password' => 'changed123'])->assertOk();
    }

    public function test_training_requires_admin()
    {
        $this->getJson('/api/training/exercises')->assertUnauthorized();
        $this->actingAs(User::factory()->create(['is_admin' => false]))->getJson('/api/training/exercises')->assertForbidden();
    }

    public function test_workout_session_and_weekly_monthly_progress()
    {
        $this->actingAs($this->admin());
        $student = User::factory()->create(['is_admin' => false]);
        $exercise = $this->postJson('/api/training/exercises', ['name' => 'Agachamento', 'muscle_group' => 'Pernas'])->assertSuccessful()->json();
        $items = [['exercise_id' => $exercise['id'], 'sets' => 3, 'reps' => 10, 'weight' => 20]];
        $url = '/api/training/'.$student->id;
        $workout = $this->postJson($url.'/workouts', ['name' => 'A', 'days_per_week' => 2, 'items' => $items])->assertSuccessful()->json();
        $this->postJson($url.'/sessions', ['performed_on' => '2026-08-31', 'items' => $items])->assertSuccessful();
        $items[0]['weight'] = 30;
        $this->postJson($url.'/sessions', ['performed_on' => '2026-09-07', 'items' => $items])->assertSuccessful();
        $this->getJson($url.'/progress?period=week&date=2026-09-07')->assertOk()->assertJsonPath('current.volume', 900)->assertJsonPath('previous.volume', 600)->assertJsonPath('changes.volume', 50)->assertJsonPath('current.muscles.Pernas', 3);
        $this->getJson($url.'/progress?period=month&date=2026-09-07')->assertOk()->assertJsonPath('changes.volume', 50);
        $this->getJson($url.'/progress?period=week&date=2026-08-31')->assertOk()->assertJsonPath('changes.volume', null);
        $other = User::factory()->create(['is_admin' => false]);
        $this->putJson('/api/training/'.$other->id.'/workouts/'.$workout['id'], ['name' => 'B', 'days_per_week' => 1, 'items' => $items])->assertNotFound();
        $this->putJson('/api/training/exercises/'.$exercise['id'], ['name' => 'Novo nome', 'muscle_group' => 'Outro'])->assertSuccessful();
        $this->getJson($url.'/progress?period=week&date=2026-09-07')->assertJsonPath('sessions.0.items.0.name', 'Agachamento');
        $items[0]['sets'] = -1;
        $this->postJson($url.'/sessions', ['performed_on' => '2026-09-07', 'items' => $items])->assertUnprocessable();
    }
}
