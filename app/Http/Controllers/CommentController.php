<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /*public function __construct()
    {
       // $this->authorizeResource(Comment::class,'comment');
    }*/

    public function store(StoreCommentRequest $request,Video $video)
    {
        $this->authorize('create',[ Comment::class,$video]);


        $video->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);
        return back()->with('alert',__('messages.comment_sent_succesfully'));
    }
}
