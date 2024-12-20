<?php

namespace App\Http\Controllers;

use App\Http\Requests\PricesHallRequest;
use App\Models\Hall;
use App\Http\Controllers\Controller;
use App\Http\Requests\HallRequest;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Hall::all();
        // return 'index';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HallRequest $request)
    {
        return Hall::query()->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $hallId)
    {
        return Hall::query()->findOrFail($hallId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HallRequest $request, int $hallId)
    {
        $hall = Hall::query()->findOrFail($hallId);
        $hall->fill($request->validated);
        return $hall->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $hallId)
    {
        $hall = Hall::query()->findOrFail($hallId);
        $seances = $hall->seances();
        $seances->delete();
        if ($hall->delete()) {
            return response(null, 204);
        }
        return null;
    }

    public function updatePrices(PricesHallRequest $request, int $hallId)
    {
        $hall = Hall::query()->findOrFail($hallId);
        $hall->fill($request->validated());
        return $hall->save();
    }

    public function getSeances(int $hallId, int|null $movieId = null)
    {
        if (!$movieId) {
            return Hall::query()->findOrFail($hallId)->seances()->get();
        }
        return Hall::query()->findOrFail($hallId)->seances()->where('movie_id', $movieId)->get();
    }

    public function getChairs(int $hallId)
    {
        return Hall::query()->findOrFail($hallId)->chairs()->get();
    }

    public function setSales(SalesRequest $request, int $hallId)
    {
        $hall = Hall::query()->findOrFail($hallId);
        $hall->fill($request->validated());
        return $hall->save();
    }

    public function getSeancesAvailable() {
        $halls = Hall::has('seances')->get();
        return $halls;
    }

}
