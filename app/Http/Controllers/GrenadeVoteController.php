<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grenade;
use App\Models\GrenadeVote;



class GrenadeVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function vote(Request $request, $grenadeId)
    {
        $user = auth()->user();
        $grenade = Grenade::findOrFail($grenadeId);
        
        // Sprawdź, czy użytkownik już oddał głos na ten granat
        $existingVote = GrenadeVote::where('user_id', $user->id)
                            ->where('grenade_id', $grenade->id)
                            ->first();
        
        // Jeśli użytkownik już głosował, zaktualizuj istniejący głos
        if ($existingVote) {
            $newVoteType = $request->input('vote_type');
            $existingVoteType = $existingVote->vote_type;
            
            // Sprawdź, czy nowy typ głosu różni się od obecnego
            if ($newVoteType !== $existingVoteType) {
                $existingVote->update([
                    'vote_type' => $newVoteType
                ]);
    
                return redirect()->back()->with('success', 'Twój głos został zaktualizowany.');
            } else {
                return redirect()->back()->with('error', 'Już oddałeś taki sam głos na ten granat.');
            }
        }
    
        // Jeśli użytkownik jeszcze nie głosował, utwórz nowy głos
        $vote = new GrenadeVote();
        $vote->user_id = $user->id;
        $vote->grenade_id = $grenade->id;
        $vote->vote_type = $request->input('vote_type');
        $vote->save();
    
        return redirect()->back()->with('success', 'Twój głos został oddany pomyślnie.');
    }
    
}