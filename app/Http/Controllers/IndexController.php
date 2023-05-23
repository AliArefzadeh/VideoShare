<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $mpv = Video::all()->random(6);
        $mvv = Video::all()->random(6);
        return view('index', compact('mpv', 'mvv'));
    }
}
