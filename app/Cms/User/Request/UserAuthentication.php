<?php

namespace Cms\User\Request;

use Cms\Base\ApiRequest;

class UserAuthentication extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "email" => "required|exists:users,email",
            "password" => "required|min:6",
            // 'role_id' => 'required|exists:roles,id'

        ];
    }
}
