<?php

namespace App\Http\Requests\V1\Review;

use App\Models\V1\Project;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class storeReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $project=Project::find($this->project_id);

        return Auth::user() && $project && $project->client_id=== Auth::user()->client->id;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'client_id'=>Auth::user()->client->id
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
          'project_id'=>['required','numeric','exists:projects,id',
          Rule::unique('reviews','project_id')],
           'freelancer_rating' => 'required|integer|min:1|max:5',
            'project_rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',


        ];
    }
}
