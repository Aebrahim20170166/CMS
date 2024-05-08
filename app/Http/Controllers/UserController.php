<?php

namespace App\Http\Controllers;

use Cms\User\Request\UserCreation;
use Cms\User\Request\UserUpdate;
use Cms\User\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }
    public function allStudents()
    {
        return $this->userService->allStudents();
    }

    public function allInstructors()
    {
        return $this->userService->allInstructors();
    }

    public function update(UserUpdate $request)
    {
        return $this->userService->update($request);
    }

    public function delete(int $userId)
    {
        ///$userId = $request->user()->id;
        return $this->userService->delete($userId);
    }
}
