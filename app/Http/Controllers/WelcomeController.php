<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
class WelcomeController extends Controller
{
    public function index()
    {
        return View('welcome' ,[
            'maps' => Map::all()
        ]);
    }
}
