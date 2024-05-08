<?php

namespace Cms\Course\Requests;

use Cms\Base\ApiRequest;

class assignGrade extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'assignment_id' =>'required|exists:assignments,id',
            'user_id' => 'required|exists:users,id',
            'grade' =>'required|numeric|min:0|max:100',
        ];
    }
}
