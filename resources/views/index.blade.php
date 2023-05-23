@extends('layout')
@section('content')
    {{--این تگهای بلید بالا برای روش ارث بری هست--}}


    {{--<x-layout>
    <x-slot name="content">--}}
    <x-latest-videos></x-latest-videos>

    <h1 class="new-video-title"><i class="fa fa-bolt"></i> پربازدیدترین ویدیوها</h1>
    <div class="row">
        @foreach($mvv as $video)
            <x-video-box :video="$video"></x-video-box>
        @endforeach
    </div>






    <h1 class="new-video-title"><i class="fa fa-bolt"></i> محبوب‌ترین‌ها</h1>
    <div class="row">
        @foreach($mpv as $video)
            <x-video-box :video="$video"></x-video-box>

        @endforeach
    </div>







    {{--</x-slot>
    </x-layout>--}}
@endsection
