<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\Grenade;
use App\Models\Callout;
use App\Models\Area;
use App\Models\User;


class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('maps.index' ,[
            'maps'=> Map::all()
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
public function show(Map $map)
{
    // Pobiera granaty dla danej mapy wraz z powiązanymi danymi użytkownika, calloutFrom, calloutTo i grenadeImages.
    $grenades = Grenade::with(['user', 'calloutFrom', 'calloutTo', 'grenadeImages'])
                       ->where('map_id', $map->id) // Zakładam, że kolumna nazywa się 'map_id' w tabeli granatów
                       ->get();

    return view('maps.show', [
        'maps' => $map,
        'grenades' => $grenades
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
