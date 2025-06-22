<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\Grenade;
use App\Models\GrenadeGroup;
use App\Models\GrenadeVote;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $maps = Map::all();
        $mapsActive = Map::where('active', 1)->get();
        $mapsOthers = Map::where('active', 0)->get();
        $grenades = Grenade::latest()->take(12)->with('grenadeImages', 'user', 'map', 'areaTo', 'calloutTo', 'favorites')->get();
        $userId = auth()->id();
        $groups = GrenadeGroup::with('map', 'grenades')->get();
        foreach ($grenades as $grenade) {
            $grenade->vote_result = GrenadeVote::calculateVotes($grenade->id); // Dodanie wyniku głosów jako właściwość
            
            // Sprawdź, czy użytkownik dodał granat do ulubionych
            $grenade->favorite = $grenade->favorites
                ->where('user_id', $userId) // Sprawdź powiązanie z zalogowanym użytkownikiem
                ->first()?->favorite ?? 0; // Jeśli brak rekordu, domyślna wartość to 0
        }
    
        return view('welcome', [
            'mapsActive' => $mapsActive,
            'mapsOthers' => $mapsOthers,
            'maps' => $maps,
            'grenades' => $grenades,
            'groups' => $groups
        ]);
    }
    
}
