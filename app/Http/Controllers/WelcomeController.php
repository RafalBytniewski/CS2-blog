<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\Grenade;

class WelcomeController extends Controller
{
    public function index()
    {
        $mapsActive = Map::where('active', 1)->get();
        $mapsOthers = Map::where('active', 0)->get();
        $grenades = Grenade::with('grenadeImages', 'user', 'map', 'areaTo', 'calloutTo')->get();

        return View('welcome' ,[
            'mapsActive' => $mapsActive,
            'mapsOthers' => $mapsOthers,
            'grenades' => $grenades
        ]);
    }
}
