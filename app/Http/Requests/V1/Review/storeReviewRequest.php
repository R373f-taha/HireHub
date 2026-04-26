<?php

namespace App\Http\Requests\V1\Review;

use App\Models\V1\Project;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class storeReviewRequest extends FormRequest
{
    /**
     * The client evaluating the performance on the project must be the project owner.
     * @return bool
     */
    public function authorize(): bool
    {
        $project=Project::find($this->project_id);

        return Auth::user() && $project && $project->client_id=== Auth::user()->client->id;
    }
        protected function failedAuthorization(): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'You cannot evaluate performance on a project that is not yours.😒😒',
            'code' => 403
        ], 403));
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
           'freelancer_rating' => 'required|integer|min:1|max:10',
            'project_rating' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string|max:1000',
            'client_id'=>'integer|exists:clients,id'
        ];
    }
    public function messages(){
        return [
        'project_id.unique' =>'This project already has a review. Each project can only submit one review.',

        ];
    }

}
