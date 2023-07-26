<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // Rule::unique('products' , 'sku')->ignore($this->product)]
        $id = $this->route('id');
        return [
            'name' => 'required|max:255' ,
            'category_id' => 'nullable|int|exists:categories,id',
            'description' => 'nullable',
            'image' => 'nullable|image|max:512000',
            'price'=>'nullable|numeric|min:0',
            'sale_price'=>'nullable|numeric|min:0',
            'quantity'=>'nullable|int|min:0',
            'sku'=>['nullable' , 'unique:products,id,' .$id ],
            'length'=>'nullable|numeric|min:0',
            'width'=>'nullable|numeric|min:0',
            'height'=>'nullable|numeric|min:0',
            'weight'=>'nullable|numeric|min:0',
            'status' => 'required|in:active,draft',
        ];
    }
}
