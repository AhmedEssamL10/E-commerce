<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'quantity' => 'required|max:3',
            'status' => 'required|in:0,1',
            'price' => 'required|max:6',
            'en_details' => 'required|max:255',
            'ar_details' => 'required|max:255',
            'code' => 'required|integer|unique:products,code',
            'brand_id' => 'integer|exists:brands,id',
            'subcategoy_id' => 'integer|exists:subcatigories,id',
            'categoy_id' => 'integer|exists:catigories,id',
            'image' => 'required|image'
        ];
    }
}
