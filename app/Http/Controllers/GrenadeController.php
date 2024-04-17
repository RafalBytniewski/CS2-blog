<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Grenade;
use App\Models\Map;
use App\Models\User;
use App\Models\Area;
use App\Models\Callout;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpsertGrenadeRequest;

class GrenadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        return View('maps.grenades.index' ,[
            'grenades' => Grenade::with('user', 'map')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Map $map)
    {     
        
         return view('maps.grenades.create', [
            'map' => $map,
            'areas' => Area::where('map_id', $map->id)->get(),
            'callouts' => Callout::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param UpsertGrenadeRequest $request
     * @return RedirectResponse
     */
    public function store(UpsertGrenadeRequest $request)
    {

        $user = auth()->user();
        $grenadeData = $request->validated();
        $grenadeData['user_id'] = $user->id;    
        $grenade = Grenade::create($grenadeData);
    
        foreach ($request->file('images') as $image) {
            $path = $image->store('public/images/grenades');
            $publicPath = str_replace('public/', '', $path);
            $grenade->grenadeImages()->create(['path' => $publicPath]);
        }
        return redirect()->route('maps.index')->with('success', 'Pomyślnie dodano grenadę!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grenade $grenade)
    {
        return view('maps.grenades.show', [
            'grenades' => Grenade::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grenade $grenade)
    {
        $types = Grenade::select('type')->distinct()->pluck('type');
        $teams = Grenade::select('team')->distinct()->pluck('team');
        $map = $grenade->map;
        $areaFrom = $grenade->areaFrom;
        $calloutFrom = $grenade->calloutFrom;
        $areato = $grenade->areato;
        $calloutTo = $grenade->calloutTo;
        $areas = Area::where('map_id', $map->id)->get();
        $callouts = Callout::all();
        $images = $grenade->grenadeImages;

        return view('maps.grenades.edit', [
            'grenade' => $grenade,
            'areaFrom' => $areaFrom,
            'calloutFrom' => $calloutFrom,
            'areaToo' => $areato,
            'calloutTo' => $calloutTo,
            'map' => $map,
            'areas' => $areas, 
            'callouts' => $callouts,
            'types' => $types,
            'teams' => $teams,
            'images' => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertGrenadeRequest $request, Grenade $grenade)
    {
        $grenade->update($request->validated());
        return redirect(route('maps.grenades.index'));
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grenade $grenade)
    {
        //
    }

    public function fetchCallouts($areaId)
    {
        $callouts = Callout::where('area_id', $areaId)->get();
        return response()->json($callouts);
    }
    
}
