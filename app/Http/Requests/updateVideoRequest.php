<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class updateVideoRequest extends StoreVideoRequest
{

    public function rules()
    {
       return array_merge(parent::rules(),[
            'slug' => ['required', Rule::unique('videos')->ignore($this->video),'alpha_dash'],
           'file'=>['file','max:5MB','mimetypes:video/mp4', 'nullable',]

        ]);

    }


}
