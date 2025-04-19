<?php

namespace Modules\Candidate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'sometimes',
            'password' => 'required|string|confirmed',
            'occupation' => 'string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
