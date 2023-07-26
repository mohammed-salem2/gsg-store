<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        // $id = $this->route('id');
        return [
            'name' => 'required',
            'email' => 'required' , 'email' , 'unique:users,email,' .Rule::unique('users' , 'email')->ignore($this->user),
            'password' => 'required|min:8',
        ];
    }
}
