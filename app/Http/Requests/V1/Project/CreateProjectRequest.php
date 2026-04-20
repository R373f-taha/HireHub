<?php

namespace App\Http\Requests\V1\Project;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->client;
    }


    protected function prepareForValidation() :void
    {
       $this->merge([
            'client_id'=>Auth::user()->client->id,
            'budget'=>json_decode($this->budget,true)
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
            'title'=>['required',
            'regex:/^[^<>{}]+$/',
            'string',
            'min:10',
            'max:20',
            function($attribute,$value,$fail)
            {
                $badwords=['Cursing', 'insult', 'hatred', 'incitement', 'humiliation', 'abuse', 'assault'];

                foreach($badwords as $word){
                    if(stripos($value,$word)!== false){
                        $fail("the title contains a bad words ($word) ...please change it");
                    }
                }

            }


            ],
            'description'=>['required',
            'regex:/^[^<>{}]+$/',
            'string',
            'min:5',
            'max:5000',
            function($attribute,$value,$fail)
            {
                $sensitiveWords=['Cursing', 'insult', 'hatred', 'incitement', 'humiliation', 'abuse', 'assault',
                'password', 'credit card', 'social security', 'ssn'];
            

                foreach($sensitiveWords as $word){
                    if(stripos($value,$word)!== false){
                        $fail("the title contains a bad words ($word) ...please change it");
                    }
                }

            }


            ],
            'type_of_balance'=>'required|string|in:hourly,fixed',
            'project_status'=>'required|string|in:open,closed,in_progress',
            'budget'=>'required|array',
            'budget.type'=>'required|in:fixed,hourly',

            //fixed rule
            'budget.amount'=>'required_if:budget.type,fixed|numeric|min:500|max:10000',

            //Hourly rules
            'budget.rate'=>'required_if:budget.type,hourly|numeric|integer|min:5|max:100',
            'budget.estimated_hours'=>'required_if:budget.type,hourly|min:1|max:500',
            'budget.min'=>'required_if:budget.type,hourly|numeric|min:200|max:500',
            'budget.max'=>'required_if:budget.type,hourly|numeric|min:500|max:2000|gt:budget.min',

            'deadline'=>'required|date|after:today',

           'client_id' => 'required|exists:clients,id',


        ];
    }

    public function messages()
    {
        return [
                'title.min'=>'the project`s :attribute must be clear and 10 letters at least',
                'title.regex'=>'title musn`t include any html codes',
                'description.min'=>'the project`s :attribute must be clear and 50 letters at least',
                'description.regex'=>'description musn`t include any html codes',
                'budget.amount.required_if'=>'fixed project require specifying an amount',
                'budget.rate.required_if'=>'fixed project require specifying the hourly rate',
                'budget.estimated_hours'=>'hourly project require specifying the hours number',
                'budet.max.gt'=>'the maximum must be greater than the minimum',

                'deadline.after'=>'deadline mustn`t be today or in the past',
                'client_id.exists'=>'the project must be follow to the specific client'
        ];
    }



}
