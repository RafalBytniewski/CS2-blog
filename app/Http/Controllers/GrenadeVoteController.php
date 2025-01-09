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
        \Log::info('Request received:', $request->all()); // Logujemy dane żądania

        // Proste sprawdzenie, czy dane przychodzą poprawnie
        if (!$request->has(['grenade_id', 'vote_type'])) {
            return response()->json([
                'success' => false,
                'message' => 'Missing grenade_id or vote_type.',
            ], 400); // 400 Bad Request
        }

        // Debuguj odpowiedź krok po kroku
        $grenadeId = $request->input('grenade_id');
        $voteType = $request->input('vote_type');

        // Przykład logiki głosowania
        \Log::info('Vote attempt:', ['grenade_id' => $grenadeId, 'vote_type' => $voteType]);

        // Na razie zwracamy statyczną odpowiedź
        return response()->json([
            'success' => true,
            'grenade_id' => $grenadeId,
            'vote_type' => $voteType,
        ]);
    }
}
