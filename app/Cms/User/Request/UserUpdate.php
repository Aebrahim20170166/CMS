<?php

namespace Cms\User\Request;

use Cms\Base\ApiRequest;

class UserUpdate extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "username" => "required|min:3|unique:users,username",
            "email" => "required|unique:users,email",

        ];
    }
}
