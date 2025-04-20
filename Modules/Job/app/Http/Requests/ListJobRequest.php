<?php

namespace Modules\Job\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListJobRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'keyword' => 'sometimes|string',
            'location' => 'sometimes|string',
            'is_remote' => 'sometimes|bool',
            'page' => 'sometimes|int|min:1',
            'size' => 'sometimes|int|min:1',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }
}
