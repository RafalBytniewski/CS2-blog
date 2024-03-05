<?php

namespace App\Http\Controllers;

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
    public function create()
    {
  
           return view('maps.grenades.create', [
            'maps' => Map::all(),
            'areas' => Area::all(),
            'callouts' => Callout::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $data = $request->validate([
            'describtion',
            'image_path' => 'required|array',
            'team',
            'type',
            'user_id',
            'map_id',
            'callout_from_id',
            'callout_to_id'
        ]);

        $images = [];

        foreach ($data['image_path'] as $image) {
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image_path =  $image->storeAs('Grenades', $fileName, 'public');

            array_push($images, $image_path);
        }

        $user = auth()->user();
        $data['user_id'] = $user->id;

        $data['images'] = $images;

        Grenade::create($data);

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
}
