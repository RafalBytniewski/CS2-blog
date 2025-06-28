<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;


use App\Models\GrenadeGroup;
use Illuminate\Http\Request;

class GrenadeGroupController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   

        $validated = $request->validate([
            'map_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'visibility' => 'required|integer',
            'description' => 'nullable|string'
        ]);
        $grenade_group = GrenadeGroup::create([
            'map_id' => $validated['map_id'],
            'name' => $validated['name'],
            'visibility' => $validated['visibility'],
            'description' => $validated['description'],
            'user_id' => auth()->id()
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(GrenadeGroup $grenadeGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GrenadeGroup $grenadeGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GrenadeGroup $grenadeGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GrenadeGroup $grenadeGroup)
    {
        //
    }

    public function getByMap($map)
    {
        $groups = GrenadeGroup::with('map')->withCount('grenades')->where('map_id', $map)->get();
        return response()->json($groups);
    }
}
