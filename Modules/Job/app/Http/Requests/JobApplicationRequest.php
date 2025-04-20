<?php

namespace Modules\Job\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class JobApplicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'resume' => [
                'required',
                File::types(['pdf', 'docx'])
                    ->min('5kb')
                    ->max('20mb')
            ],
            'cover_letter' => [
                'required',
                File::types(['pdf', 'docx'])
                    ->min('5kb')
                    ->max('20mb')
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('candidate-api')->check();
    }
}
