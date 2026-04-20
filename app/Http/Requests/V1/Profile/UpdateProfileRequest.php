<?php

namespace App\Http\Requests\V1\Profile;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->freelancer &&Auth::user()->freelancer->id ===$this->freelancer_id ;
    }

     protected function failedAuthorization(): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'You do not have permission to edit this profile',
            'code' => 403
        ], 403));
    }


   protected function prepareForValidation():void
    {
    $this->merge([
     'freelancer_id'=>Auth::user()->freelancer->id
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
            'bio'=>['sometimes','regex:/^[^<>{}]+$/',
            'string',
            'min:10',
            'max:500',],
            'first_name'=>'sometimes|string|min:3|max:255',
            'last_name'=>'sometimes|string|min:3|max:255',
            'image'=>'sometimes|image|mimes:png,jpg,gif,jpeg|max:2048',
            'protofilo_link'=>'sometimes|url|max:500',
            'hour_rate'=>'sometimes|numeric',
            'available_mode'=>'sometimes|in:available,busy,not available',
            'skills_summery'=>['sometimes','regex:/^[^<>{}]+$/',
            'string',
            'min:5',
            'max:255',],
        ];
    }
}
