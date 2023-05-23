<?php
namespace App\Services;


use FFMpeg\FFMpeg;
use Illuminate\Support\Facades\Storage;

class FFMpegAdaptor
{
    public function __construct(public string $path)
    {
       $this->ffprobe = \FFMpeg\FFProbe::create([
            'ffmpeg.binaries' => 'C:/wamp64_2/www/laravel/laravel-mix/public/ffmpeg-n6.0-latest-win64-lgpl-6.0/bin/ffmpeg.exe',
            'ffprobe.binaries' => 'C:/wamp64_2/www/laravel/laravel-mix/public/ffmpeg-n6.0-latest-win64-lgpl-6.0/bin/ffprobe.exe',
        ]);
       $this->video_porbe=$this->ffprobe->format(Storage::path($this->path));


        $this->ffmpeg = \FFMpeg\FFMpeg::create([
            'ffmpeg.binaries' => 'C:/wamp64_2/www/laravel/laravel-mix/public/ffmpeg-n6.0-latest-win64-lgpl-6.0/bin/ffmpeg.exe',
            'ffprobe.binaries' => 'C:/wamp64_2/www/laravel/laravel-mix/public/ffmpeg-n6.0-latest-win64-lgpl-6.0/bin/ffprobe.exe',
        ]);
        $this->video = $this->ffmpeg->open(Storage::path($this->path));


    }

    public function getDuration()
    {
        return ((int) $this->video_porbe->get('duration'));
    }

    public function getFrame()
    {
        //متغیر زیر اسم فایل ویدیو رو درمیاره
        $fileName=pathinfo($this->path,PATHINFO_FILENAME) . '.jpg';
          $this->video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(4))
            ->save(storage_path('app/public/'. $fileName));
        return $fileName;
    }


}

