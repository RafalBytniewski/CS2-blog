<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Grenade;
use App\Models\Map;
use App\Models\User;
use App\Models\Area;
use App\Models\Callout;
use App\Models\GrenadeVote;
use App\Models\GrenadeImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpsertGrenadeRequest;
use App\Http\Requests\UpdateGrenadeRequest;


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
            $path = $image->store('images/grenades');
            
            $grenade->grenadeImages()->create(['path' => $path]);
        }
        return redirect()->route('grenade.show', $grenade->id)->with('success', 'Pomyślnie dodano granat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grenade $grenade)
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

        return view('maps.grenades.show', [
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
     * Show the form for editing the specified resource.
     */
    public function edit(Grenade $grenade)
    {
        $types = Grenade::select('type')->distinct()->pluck('type');
        $teams = Grenade::select('team')->distinct()->pluck('team');
        $map = $grenade->map;
        $visibility = $grenade->visibility;
        $areaFrom = $grenade->areaFrom;
        $calloutFrom = $grenade->calloutFrom;
        $areato = $grenade->areato;
        $calloutTo = $grenade->calloutTo;
        $areas = Area::where('map_id', $map->id)->get();
        $callouts = Callout::all();
        $images = $grenade->grenadeImages;

        return view('maps.grenades.edit', [
            'grenade' => $grenade,
            'visibility' => $visibility,
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
    public function update(UpdateGrenadeRequest $request, Grenade $grenade)
    {
        $grenade->update($request->validated());
        return redirect()->route('grenade.show', $grenade)->with('success', 'Dane zostały zaktualizowane.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grenade $grenade)
    {
            GrenadeImage::where('grenade_id', $grenade->id)->delete();
            GrenadeVote::where('grenade_id', $grenade->id)->delete();
            $grenade->delete();     
            return redirect()->back()->with('success', 'Grenade deleted successfully');
    }


    public function fetchCallouts($areaId)
    {
        $callouts = Callout::where('area_id', $areaId)->get();
        return response()->json($callouts);
    }
    
}
