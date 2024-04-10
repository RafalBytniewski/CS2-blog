<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Map;
use App\Models\Grenade;
use App\Models\Callout;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpsertMapRequest;


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
        return View('maps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertMapRequest $request)
    {
        $map = new Map($request->validated());

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('public/images/maps');
            $publicPath = str_replace('public/', '', $path);
            $map->image_path = $publicPath;
        }
        $map->save();
        return redirect()->route('maps.index');
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
    public function edit(Map $map)
    {
        return view('maps.edit',[
            'map' => $map
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertMapRequest $request, Map $map)
    {

        $oldImagePath = $map->image_path;
        $map ->fill($request->validated());
        if ($request->hasFile('image_path')) {
            if(Storage::exists($oldImagePath)){
                Storage::delete($oldImagePath);
            }
            $path = $request->file('image_path')->store('public/images/maps');
            $publicPath = str_replace('public/', '', $path);
            $map->image_path = $publicPath;
        }
        $map->save();

        return redirect()->route('maps.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fetchCallouts(Area $area)
    {
        $callouts = $area->callouts;
        return response()->json($callouts);
    }

    public function settings(Map $map)
    {

        $areas = Area::with('callouts')->where('map_id', $map->id)->get();
        

        return view('maps.settings', [
            'map' => $map,
            'areas' => $areas
        ]); 
    }
}
