<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class VideoFilters
{
    public function __construct(public Builder $builder)
    {

    }

    public function apply($params)
    {
        foreach ($params as $methodeName => $value) {
            // if(!method_exists($this,$methodName)) continue; // in khat ro ezaf kardam

            if (is_null($value)) continue;

            $this->$methodeName($value);
            //در متن بالا باعث میشه که فانکشن های زیر به ترتیب فراخونده بشن
            //برای مثال $methodeName مقدار داخلش برابر sortBy هست
            //و $Value مقدار داخلش برابر like هست
            //پس this->$methodeName($value)
            // برابر میشه با this->sortBy('like')
        }


        /* foreach ($params as $methodeName =>$value) {
             dump($methodeName,$value);
         }
         die();*/
    }

    private function sortBy($value)
    {
        if ($value == 'like') {
            $this->builder->leftJoin('likes', function ($join) {
                $join->on('likes.likeable_id', '=', 'videos.id')
                    ->where('likes.likeable_type', '=', 'App\models\video')
                    ->where('likes.vote', '=', '1');
            })->groupBy('videos.id')->select(['videos.*', DB::raw('count(likes.id) as count')])->orderBy('count', 'desc');

        }
        if ($value == 'length') {
            $this->builder->orderByDesc('length');
        }
        if ($value == 'created_at') {
            $this->builder->orderByDesc('created_at');
        }
    }

    private function q($value)
    {

         $this->builder->where('name', 'like', "%{$value}%")
            ->orwhere('description', 'like', "%{$value}%");
        //اون like در بالا یک دستور sql هست

    }

    private function length($value)
    {
        if ($value == 1) {
            $this->builder->where('length', '<', 60);
        }
        if ($value == 2) {
            $this->builder->whereBetween('length', [60, 300]);
        }
        if ($value == 3) {
            $this->builder->where('length', '>', 300);
        }

    }

    /*private function q($value)
    {

            $this->builder->where('name','like',"%{$value}%")
                ->orwhere('description','like',"%{$value}%");
            //اون like در بالا یک دستور sql هست

    }*/


}
