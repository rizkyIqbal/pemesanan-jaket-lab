<?php

namespace App\Http\Requests\Jacket;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required',
            // "image" => "required|mimes:jpeg,png,jpg",
            // // "image" => "required|image",
            // "color" => "required",
            // // "price" => "required|integer"
            'name' => 'required',
            "image" => "required|size:10000|mimes:jpeg,png,jpg",
            "color" => "required",
            "price" => "required"
        ];
    }
}
