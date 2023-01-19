<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GangaPost extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'url' => 'required',
            'price' => 'required',
            'price_sale' => 'required',
            'category' => 'required',
        ];
    }
}
