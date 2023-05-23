<div class="col-lg-2 col-md-4 col-sm-6">
    <div class="video-item">
        <div class="thumb">
            <div class="hover-efect"></div>
            {{--متد gmdate برای تبدیل ثانیه است--}}
            {{--ولی اینجا استفاده نکردیم به جاش تغییر رو در پوشه Model/video انجام دادیم--}}
            <small class="time">{{$video->lengthInHuman}}</small>
            <a href="{{route('videos.show',$video->slug)}}"><img src="{{$video->VideoThumnail}}" alt=""></a>
        </div>
        <div class="video-info">
            <a href="{{route('videos.show',$video->slug)}}" class="title">{{$video->name}}</a>

           {{-- @can('edit-video',$video)--}}
            {{--متن بالا برای وقتیه که از gate بخوای استفاده کنی--}}
             @can('update',$video)
            <a href="{{route('videos.edit',$video->slug)}}">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            @endcan

            <a class="channel-name" href="#">{{$video->OwnerName}}<span>
                                    <i class="fa fa-check-circle"></i></span></a>
            <span class="views"><i class="fa fa-eye"></i>2.8M بازدید </span>
            <span class="date"><i class="fa fa-clock-o"></i>{{$video->created_at}} </span>
            {{--<span class="date"><i class="fa fa-tag"></i>{{$video->category?->name}} </span>--}}
            {{--این ؟ برای اینکه که اگر کتگوری null  بود ارور بهمون نده--}}
            <span class="date"><i class="fa fa-tag"></i>{{$video->Category_name}} </span>
            {{--در واقع ما یه متد توی video.php نوشتیم که اگر خواستیم name رو
            تغییر بدیم لازم نباشه تو هر صفحه اینکارو بکنیم و به اینکار میگن ریفکتور--}}

        </div>
    </div>
</div>
