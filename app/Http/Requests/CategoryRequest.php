<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Type\Integer;

class CategoryRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            // 'required|string|max:255|min:3|unique:categories,name,'
            'name' => ['required' , 'string' , 'max:255' , 'min:3' , 'unique:categories,id,' .$id],
            'parent_id' => 'nullable|int|exists:categories,id',
            'description' => 'nullable|min:5',
            'status' => 'required|in:active,draft',
            'image' => 'image|max:512000|dimensions:min_width=300,min_height=300', // هان الحجم بكون بالبايت يعني 1024 بايت بتساوي 1 كيلو
        ];
    }
    public function message()
    {
        //
    }
}
