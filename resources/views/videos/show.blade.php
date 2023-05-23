@extends('layout')
@section('content')

    <div class="row">
        <x-validation-errors></x-validation-errors>

        <!-- Watch -->
        <div class="col-md-8">
            <div id="watch">
                <!-- Video Player -->
                <h1 class="video-title">{{$video->name}}</h1>
                <div class="video-code">
                    <video controls style="height: 100%; width: 100%;">
                        <source
                            src="{{$video->video_url}}"
                            type="video/mp4">
                    </video>
                </div><!-- // video-code -->
                <div>
                    <p>
                        {{$video->description}}
                    </p>
                </div>

                <div class="video-share">
                    <ul class="like">
                        <li><a class="deslike" href="{{route('dislikes.store',['likeable_type'=>'video','likeable_id'=>$video])}}">{{$video->DislikesCount}}<i class="fa fa-thumbs-down"></i></a></li>
                        <li><a class="like" href="{{route('likes.store',['likeable_type'=>'video','likeable_id'=>$video])}}">{{$video->likesCount}}<i class="fa fa-thumbs-up"></i></a></li>
                    </ul>
                    <ul class="social_link">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="youtube" href="#"><i class="fa fa-youtube-play"
                                                           aria-hidden="true"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="google" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                    </ul><!-- // Social -->
                </div><!-- // video-share -->
                <!-- // Video Player -->


                <!-- Chanels Item -->
                <div class="chanel-item">
                    <div class="chanel-thumb">
                        <a href="#"><img src="{{$video->user->Gravatar}}" alt=""></a>
                    </div>
                    <div class="chanel-info">
                        <a class="title" href="#">{{$video->user->name}}</a>
                        <span class="subscribers">436,414 اشتراک</span>
                    </div>
                    <a href="#" class="subscribe">اشتراک</a>
                </div>
                <!-- // Chanels Item -->


                <!-- Comments -->
                <div id="comments" class="post-comments">
                    <h3 class="post-box-title"><span>{{$video->comments->count()}}</span> نظرات </h3>
                    <ul class="comments-list">

                        {{--@foreach($video->comments->sortByDesc('created_at') as $comment)--}}
                        {{-- اون sortByDesc('created_at') که بالا نوشتی یعنی از پایین به بالا کامنتهارو نشون بده بر اساس  --}}
                        {{-- فیلد created_at , حالا اگر میخوای از پایین به بالا باشه کلا حذفش میکنیم  --}}
                        @foreach($video->comments as $comment)
                            {{--میتونی هم کلا حذفش کنی و نوشته کامنتا از بالا به پایین رو در صفحه Video.php انجام بدی در متد comments--}}
                            <li>
                                <div class="post_author">
                                    <div class="img_in">
                                        <a href="#"><img src="{{$comment->user->Gravatar}}" alt=""></a>
                                    </div>
                                    <a href="#" class="author-name">{{$comment->user->name}}</a>
                                    <time datetime="2017-03-24T18:18">{{$comment->createdAtInHuman}}</time>

                                    <a href="{{route('dislikes.store',['likeable_type'=>'comment','likeable_id'=>$comment])}}" class="deslike mr-5" style="color: #aaaaaa; padding:5px ">
                                        {{$comment->dislikes_count}}<i class="fa phpdebugbar-fa-thumbs-down"></i>
                                    </a>
                                    <a href="{{route('likes.store',['likeable_type'=>'comment','likeable_id'=>$comment])}}" class="like mr-5" style="color: #66c0c2">
                                        {{$comment->likes_count}}<i class="fa phpdebugbar-fa-thumbs-up"></i>
                                    </a>
                                </div>
                                <p>{{$comment->body}}
                                </p>

                            </li>
                        @endforeach

                    </ul>

                    @auth()
                        @can('create',[\App\Models\Comment::class,$video])
                        <h3 class="post-box-title">ارسال نظرات</h3>
                        <form action="{{route('comments.store',$video)}}" method="post">
                            @csrf
                            <textarea class="form-control" name="body" rows="8" id="Message"
                                      placeholder="پیام"></textarea>
                            <button type="submit" id="contact_submit" class="btn btn-dm">ارسال پیام</button>
                        </form>
                        @endcan
                @endauth

                @guest()
                    <h3 class="post-box-title">ارسال نظرات</h3><form action="{{route('comments.store',$video)}}" method="post">
                        @csrf
                        <div class="form-control" id="Message">برای ارسال نظر وارد شوید</div>



                @endguest
                </div>
                <!-- // Comments -->


            </div><!-- // watch -->
        </div><!-- // col-md-8 -->
        <!-- // Watch -->
        {{--<x-related-videos></x-related-videos>--}}
        <x-related-videos :video="$video"/>
        <!-- Related Posts-->
        <!-- // Related Posts -->
    </div>

@endsection()
