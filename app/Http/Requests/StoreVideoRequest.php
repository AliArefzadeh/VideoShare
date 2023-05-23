<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class   StoreVideoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => ['required'],
            'slug' => ['required', 'unique:videos,slug','alpha_dash'],
            'file' => ['required', 'file','max:5MB','mimetypes:video/mp4'],
            'category_id'=>['required','exists:categories,id']
        ];
    }

    public function messages()
    {
        return [
            'file.*' => 'فایل باید ویدویی بوده و زیر 5MB باشد',

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),

        ]);
    }
}
