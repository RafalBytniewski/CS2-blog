<?php

namespace App\Http\Controllers;

use App\Models\Grenade;
use App\Models\Map;
use App\Models\User;
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
            'maps' => Map::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $user = auth()->user();
        $grenadeData = $request->all();
        $grenadeData['user_id'] = $user->id;

        // Utwórz nową instancję Grenade i zapisz do bazy danych
        $grenade = Grenade::create($grenadeData);

        return redirect(route('maps.index'));
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
