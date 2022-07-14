<?php

namespace App\Http\Requests\Size;

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
            // 'name' => 'required|string',
            // "a" => "required|string",
            // "b" => "required|string",
            // "c" => "required|string"
            'name' => 'required',
            "a" => "required",
            "b" => "required",
            "c" => "required"
        ];
    }
}
