<?php

namespace App\Http\Controllers;

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
        $hall->delete();
        return 'ok';
    }
}
