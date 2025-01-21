<?php

namespace App\Http\Controllers;

use App\Models\GrenadeFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class GrenadeFavoriteController extends Controller
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
    public function create(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'User must be logged in to vote.'], 403);
        }
        $user = Auth()->user();

        $userId = $user->id;
        $grenadeId = $request->input('grenade_id');   

        $existingFavorite = DB::table('grenade_favorites')
            ->where('user_id', $userId)
            ->where('grenade_id', $grenadeId)
            ->first();
            if ($existingFavorite) {
                if ($existingFavorite->favorite === 1) {
                    DB::table('grenade_favorites')
                        ->where('id', $existingFavorite->id)
                        ->update(['favorite' => 0]);
                    return response()->json(['success' => true, 'message' => 'Favorite unset successfully!']);
                } else {
                    DB::table('grenade_favorites')
                        ->where('id', $existingFavorite->id)
                        ->update(['favorite' => 1]);
                    return response()->json(['success' => true, 'message' => 'Favorite set successfully!']);
                }
            } else {
                DB::table('grenade_favorites')->insert([
                    'user_id' => $userId,
                    'grenade_id' => $grenadeId,
                    'favorite' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                return response()->json(['success' => true, 'message' => 'Data inserted successfully!']);
            }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GrenadeFavorite $grenadeFavorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GrenadeFavorite $grenadeFavorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GrenadeFavorite $grenadeFavorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GrenadeFavorite $grenadeFavorite)
    {
        //
    }
}
