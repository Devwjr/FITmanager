<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $allowed = [
            AllowedFilter::exact('entity_id'),
            AllowedFilter::exact('type'),
            AllowedFilter::scope('entity'),
        ];

        $results = QueryBuilder::for(Activity::class)
            ->allowedFilters($allowed)
            ->orderBy('activities.created_at', 'DESC')
            ->paginate(request()->get('per_page', 15))
            ->appends(request()->query());

        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreActivityRequest $request)
    {
        $result = Activity::create($request->only([
            'entity_id',
            'type',
            'description',
        ]));

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(Activity $activity)
    {
        return response()->json($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $result = $activity->update($request->only([
            'entity_id',
            'type',
            'description',
        ]));

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json(null, 204);
    }
}
