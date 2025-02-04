<?php

namespace Cms\Course\Requests;

use Cms\Base\ApiRequest;

class StoreAssignment extends ApiRequest
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
            'name' =>'required|max:255',
            'content' =>'required',
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
