<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckVerifyEmail;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\updateVideoRequest;
use App\Models\Category;
use App\Models\Video;
use App\Policies\VideoPolicy;
use App\Services\FFMpegAdaptor;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Video::class, 'video');

        $this->middleware(CheckVerifyEmail::class, ['only' => ['create']]);
    }

    public function index()
    {
        $videos = Video::all();
        return $videos;
    }

    public function create()
    {


        $categories = Category::all();
        return view('videos.create', compact('categories'));
    }

    public function store(StoreVideoRequest $request)
    {

        (new VideoService)->create($request->user(), $request->all());
        $request->validate([
            /* 'name' => ['required'],
             'length' => ['required', 'integer'],
             'slug' => ['required', 'unique:videos,slug'],
             'url' => ['required', 'url'],
             'thumbnail' => ['required', 'url'],*/
        ]);
        return redirect()->route('index')->with('alert', __('messages.success'));


    }

//به جای استفاده از بالایی ما از زیر استفاده میکنیم که اصولی تر هست
    public function show(Video $video)
    {
        $video->load('comments.user');
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {

        $categories = Category::all();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(updateVideoRequest $request, Video $video)
    {
        (new VideoService())->update($video, $request->all());
        return redirect()->route('videos.show', $video->slug)->with('alert', __('messages.video_edited'));

    }
}
