<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "user_id" => "required",
            "jacket_id" => "required",
            "size_id" => "required",
            "order_type" => "required",
            // "custom" => "required",
            "price" => "required",
            // "proof" => "required",
        ];
    }
}
