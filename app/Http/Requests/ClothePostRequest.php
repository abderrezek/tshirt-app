<?php

namespace App\Http\Requests;

use App\Rules\ArrayAtLeastOneBoolTrue;
use Illuminate\Foundation\Http\FormRequest;

class ClothePostRequest extends FormRequest
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
            'marque' => 'required|exists:marques,id',
            'name' => 'required|string|min:3|max:50|unique:clothes',
            'qte' => 'required|numeric|gt:0|lt:100000000000001',
            'price' => 'required|numeric|gt:0|lt:100000000000001',
            'isSolde' => 'required|boolean',
            'solde' => 'exclude_if:isSolde,false|numeric|gt:0|lte:price',
            'description' => 'nullable|string|min:5',
            'size' => [
                'required',
                'array',
                'size:7',
                new ArrayAtLeastOneBoolTrue(),
            ],
            'color' => [
                'required',
                'array',
                'min:1',
            ],
            'image' => 'nullable|image',
        ];
    }
}
