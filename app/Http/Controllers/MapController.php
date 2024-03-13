<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    $areas = Area::with(['callouts'])
                    ->where('map_id', $map->id)
                    ->get();
   


    $grenades = Grenade::with(['user', 'calloutFrom', 'calloutTo', 'grenadeImages', 'areaFrom', 'areaTo'])
                       ->where('map_id', $map->id) 
                       ->get();
                       $types = DB::table('grenades')->select('type')->distinct()->pluck('type');

    return view('maps.show', [
        'areas' => $areas,
        'maps' => $map,
        'grenades' => $grenades,
        'types' => $types
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
