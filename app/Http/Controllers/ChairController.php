<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChairRequest;
use Illuminate\Http\Request;
use App\Models\Chair;

class ChairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'index';
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ChairRequest $request)
    {
        $chairs = $request->validated()['chairs'];
        $array = [];
        foreach ($chairs as $chair) {
            $item = [
                'hall_id' => $chair['hall_id'],
                'row' => $chair['row'],
                'place' => $chair['place'],
                'type' => $chair['type'],
            ];
            $array[] = Chair::query()->create($item);
        }
        return $array;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $CharId)
    {
        return Chair::query()->findOrFail($CharId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chair $chair)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chair $chair)
    {
        //
    }
}
