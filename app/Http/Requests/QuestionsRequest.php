<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class QuestionsRequest extends FormRequest
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
    $slug = $this->route('slug');
        return [
            'title'=>['required',"min:10","string", Rule::unique('questions', 'title')->ignore(Question::whereSlug($slug)->first())],
            'body'=>['required',"min:10","string"],
            'tags'=>['required','min:1','array'],
            'tags.*'=>['required']
        ];
    }
}
