<?php

namespace App\Http\Controllers;

use App\Models\Callout;
use Illuminate\Http\Request;
use App\Models\Area;


class CalloutController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $areaId = $request->input('area_id');

        // Sprawdź, czy area istnieje
        $area = Area::findOrFail($areaId);
    
        // Twórz nowy callout dla konkretnej area
        $callout = new Callout();
        $callout->name = $request->input('name');
        $callout->area_id = $areaId;
        $callout->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Callout $callout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Callout $callout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    $calloutId = $request->input('callout_id'); // Pobierz ID callout z zapytania

    $callout = Callout::findOrFail($calloutId); // Znajdź callout na podstawie ID

    $callout->fill($request->only(['name'])); // Uaktualnij tylko pole 'name'

    $callout->save();

    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Callout $callout)
    {
        $callout->delete();
            
        // Przekieruj z komunikatem sukcesu
        return redirect()->back()->with('success', 'Callout deleted successfully');

    }
}
