<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class GrenadeVoteController extends Controller
{
   
   
    public function vote(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to vote.'
            ], 401);
        }

        $user = Auth()->user();
        $userId = $user->id;
        $grenadeId = $request->input('grenade_id');
        $voteType = $request->input('vote_type');

                // Sprawdzenie, czy użytkownik już głosował
                $existingVote = DB::table('grenade_votes')
                ->where('user_id', $userId)
                ->where('grenade_id', $grenadeId)
                ->first();
    
            if ($existingVote) {
                // Jeśli głos jest taki sam, nie rób nic
                if ((int)$existingVote->vote_type === (int)$voteType) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You have already voted the same way.',
                    ]);
                }
    
                // Jeśli głos jest inny, zaktualizuj go
                DB::table('grenade_votes')
                    ->where('id', $existingVote->id)
                    ->update(['vote_type' => $voteType]);
            } else {
                // Jeśli użytkownik jeszcze nie głosował, dodaj głos
                DB::table('grenade_votes')->insert([
                    'user_id' => $userId,
                    'grenade_id' => $grenadeId,
                    'vote_type' => $voteType,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    
            // Oblicz nowy wynik głosowania
            $likes = DB::table('grenade_votes')
                ->where('grenade_id', $grenadeId)
                ->where('vote_type', 1)
                ->count();
    
            $dislikes = DB::table('grenade_votes')
                ->where('grenade_id', $grenadeId)
                ->where('vote_type', -1)
                ->count();

            $result = DB::table('grenade_votes')
                ->where('grenade_id', $grenadeId)
                ->sum('vote_type');
    
        // Na razie zwracamy statyczną odpowiedź
        return response()->json([
            'success' => true,
            'message' => 'Vote recorded successfully.',
            'result' => $result // Dodaj wynik do odpowiedzi
        ]);
    }
}
