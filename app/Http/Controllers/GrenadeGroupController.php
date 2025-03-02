<?php

namespace App\Http\Controllers;

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
        // Walidacja danych
        
        $validated = $request->validate([
            'map_id' => 'required|integer',
            'user_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'visibility' => 'required|integer',
            'description' => 'nullable|string'
        ]);
        $grenade_group = GrenadeGroup::create($validated);
        return redirect('/')->with('success', 'Pomyślnie dodano grupę!');
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
}
