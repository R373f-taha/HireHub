<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function  prepareForValidation() :void
    {
       $this->merge([

        'location_info'=>json_decode($this->location_info,true)
       ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|unique:users,email',
            'password'=>'required|string|min:8|confirmed',
            'role'=>'required|string|in:admin,freelancer,client',
            'city_id'=>'required|exists:cities,id',
            'is_verified' => 'required_if:role,freelancer|boolean',
            'is_active' => 'required_if:role,freelancer|boolean',
            'location_info' => 'required_if:role,freelancer,client|array',

        ];
    }
    public function messages(){
        return [
        'role.in' =>'the role must be in freelancer,client,admin',
        'is_verified.boolean'=>'the verified field must be 1 or 0',
        'is_active.boolean'=>'the active field must be 1 or 0'
        ];
    }
}
