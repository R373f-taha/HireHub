<?php

namespace App\Http\Requests\V1\Offer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->freelancer;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function prepareForValidation():void
    {
     $this->merge([
        'freelancer_id'=>Auth::user()->freelancer->id
    ]);
    }

    public function rules(): array
    {
        return [
         'project_id'=>'required|numeric|exists:projects,id',
         'proposed_amount'=>'required|numeric|min:100|max:1500',
         'delivered_days'=>'required|integer|min:5|max:60',
         'submission_letter'=>['required',
            'regex:/^[^<>{}]+$/',
            'string',
            'min:50',
            'max:5000',
            function($attribute,$value,$fail)
            {
               $sensitiveWords=['Cursing', 'insult', 'hatred', 'incitement', 'humiliation', 'abuse', 'assault',
                'password', 'credit card', 'social security', 'ssn'];
                 

                foreach($sensitiveWords as $word){
                    if(stripos($value,$word)!== false){
                        $fail("the submission letter contains a bad words ($word) ...please change it");
                    }
                }}

         ]
        ];
    }
}
