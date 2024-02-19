<?php

namespace App\Http\Controllers;

use App\Models\Grenede;
use App\Models\Map;
use Illuminate\Http\Request;

class GrenedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($map)
    {
        $selectedMap = Map::find($map);
    
        return view('maps.create', [
            'selectedMap' => $selectedMap,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Grenede $grenede)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grenede $grenede)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grenede $grenede)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grenede $grenede)
    {
        //
    }
}
