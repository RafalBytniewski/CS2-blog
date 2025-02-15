<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Grenade;
use App\Models\Map;
use App\Models\User;
use App\Models\Area;
use App\Models\Callout;
use App\Models\GrenadeVote;
use App\Models\GrenadeImage;
use App\Models\GrenadeFavorite;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpsertGrenadeRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

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
        try {
            $user = auth()->user();
            $grenadeData = $request->validated();
            $grenadeData['user_id'] = $user->id;

            if (!empty($grenadeData['youtube_path'])) {
                $grenadeData['youtube_path'] = $this->extractYouTubeId($grenadeData['youtube_path']);
            }

            $grenade = Grenade::create($grenadeData);
            
            if (isset($grenadeData['images'])) {
                foreach ($request->file('images') as $image) { 
                    $watermark = Storage::get('images/watermark/watermark.png');
                    $path = $image->store('images/grenades');
                    Image::read(Storage::get($path))
                        ->place(
                            element: $watermark,
                            position: 'bottom-right',
                            offset_x: 10, // 10px from the right
                            offset_y: 10, // 10px from the bottom
                            opacity: 90 //
                        )
                        ->save(Storage::path($path));
                    $grenade->grenadeImages()->create(['path' => $path]);
                }
            }
            
            return redirect()
                ->route('grenade.show', $grenade->id)
                ->with('success', 'Pomyślnie dodano granat!');
        } catch (\Exception $e) {
            \Log::error('Błąd podczas dodawania granatu: ' . $e->getMessage());
            return redirect()
                ->route('grenade.create')
                ->with('error', 'Wystąpił błąd podczas dodawania granatu. Spróbuj ponownie.');
        }
    }

    private function extractYouTubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/[^\/]+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

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
        $grenade->vote_result = GrenadeVote::calculateVotes($grenade->id);
        
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
    public function update(UpsertGrenadeRequest $request, Grenade $grenade)
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
            GrenadeFavorite::where('grenade_id', $grenade->id)->delete();
            $grenade->delete();     
            return redirect()->back()->with('success', 'Grenade deleted successfully');
    }


    public function fetchCallouts($areaId)
    {
        $callouts = Callout::where('area_id', $areaId)->get();
        return response()->json($callouts);
    }
    
}
