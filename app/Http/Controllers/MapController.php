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
use Illuminate\Database\QueryException;

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
            $path = $request->file('image_path')->store('images/maps');
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
                       ->where('map_id', $map->id)->where('visibility', 1) 
                       ->get();
    $types = DB::table('grenades')->select('type')->distinct()->pluck('type');

    return view('maps.show', [
        'areas' => $areas,
        'maps' => $map,
        'grenades' => $grenades,
        'types' => $types
    ]);
}

public function filter(Request $request, Map $map)
{

    $filters = $request->all();
    dd($filters);
    $query = Grenade::with(['user', 'calloutFrom', 'calloutTo', 'grenadeImages', 'areaFrom', 'areaTo'])
                    ->where('map_id', $map->id)
                    ->where('visibility', 1);

    if (isset($filters['team'])) {
        $query->where('team', $filters['team']);
    }
    if (isset($filters['type'])) {
        $query->where('type', $filters['type']);
    }
    if (isset($filters['area_from_id'])) {
        $query->whereIn('area_from_id', explode(',', $filters['area_from_id']));
    }
    if (isset($filters['callout_from_id'])) {
        $query->whereIn('callout_from_id', explode(',', $filters['callout_from_id']));
    }
    if (isset($filters['area_to_id'])) {
        $query->whereIn('area_to_id', explode(',', $filters['area_to_id']));
    }
    if (isset($filters['callout_to_id'])) {
        $query->whereIn('callout_to_id', explode(',', $filters['callout_to_id']));
    }

    $filteredGrenades = $query->get();

    $areas = Area::with(['callouts'])
                 ->where('map_id', $map->id)
                 ->get();
                 \Log::info('Filtering data for map:', ['map_id' => $map->id, 'filters' => $request->all()]);
    return response()->json([
        'grenades' => $filteredGrenades,
        'areas' => $areas
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
        // Przypisanie starej ścieżki obrazu
        $oldImagePath = $map->image_path;
    
        // Wypełnienie modelu danymi z formularza
        $map->fill($request->validated());
    
        // Sprawdzenie, czy nowy obraz został przesłany
        if ($request->hasFile('image_path')) {
            // Sprawdzenie, czy stara ścieżka obrazu nie jest null i czy plik istnieje
            if (!is_null($oldImagePath) && Storage::exists($oldImagePath)) {
                // Usunięcie starego obrazu
                Storage::delete($oldImagePath);
            }
    
            // Przechowywanie nowego obrazu
            $path = $request->file('image_path')->store('images/maps');
            $publicPath = str_replace('public/', '', $path);
    
            // Aktualizacja ścieżki obrazu w modelu
            $map->image_path = $publicPath;
        }
    
        // Zapisanie modelu
        $map->save();
    
        // Przekierowanie do listy map
        return redirect()->route('maps.index');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Map $map)
     {
         try {
             $map->delete();     
             return redirect()->back()->with('success', 'Map deleted successfully');
         } catch (QueryException $e) {
             if ($e->getCode() === '23000') {
                 return redirect()->back()->with('error', 'This map cannot be deleted because it has associated records.');
             }
         }
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
