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


class GrenadeController extends Controller
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
    public function create(Map $map)
    {
        $types = DB::table('grenades')->select('type')->distinct()->pluck('type');
        $teams = DB::table('grenades')->select('team')->distinct()->pluck('team');
            
        return view('maps.grenades.create', [
            'map' => $map,
            'areas' => Area::all(),
            'callouts' => Callout::where('area_id', 46)->get(),
            'types' => $types,
            'teams' => $teams,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $grenadeData = $request->all();
        $grenadeData['user_id'] = $user->id;
        $grenade = Grenade::create($grenadeData);
    
        foreach ($request->file('images') as $image) {
            $path = $image->store('public/images/grenades');
            $publicPath = str_replace('public/', '', $path);
            $grenade->grenadeImages()->create(['path' => $publicPath]);
        }
    
        return redirect()->route('maps.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grenade $grenade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grenade $grenade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grenade $grenade)
    {
        //
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
