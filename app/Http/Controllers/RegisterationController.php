<?php

namespace App\Http\Controllers;

use Cms\User\Services\RegisterationService;
use Cms\User\Request\UserAuthentication;
use Cms\User\Request\UserCreation;
use Illuminate\Http\Request;

class RegisterationController extends Controller
{
    public function __construct(private RegisterationService $registerationService)
    {

    }

    public function signup(UserCreation $request)
    {
        return $this->registerationService->store($request);
    }

    public function login(UserAuthentication $request)
    {
        return $this->registerationService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->registerationService->logout($request);
    }
}
