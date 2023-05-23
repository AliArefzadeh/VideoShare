<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryVideoController extends Controller
{
    public function index(Request $request, Category $category)
    {


        $title = $category->name;

        $videos = $category
            ->videos()
            ->filter($request->all())
            ->sort($request->all())
            ->Paginate()->withQueryString();
        return view('videos.index', compact('videos', 'title'));
    }
}
