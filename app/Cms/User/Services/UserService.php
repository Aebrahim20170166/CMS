<?php

namespace Cms\User\Services;

use App\Http\Resources\userResource;
use Cms\Base\Services\RoleService;
use Cms\Base\Traits\GeneralTrait;
use Cms\User\Models\User;
use Cms\User\Request\UserCreation;
use Cms\User\Request\UserUpdate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserService
{
    use GeneralTrait;
    public function __construct(private RoleService $roleService)
    {

    }
    public function allStudents()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'student');
        })->get();
        return $this->returnData('data', ['users' => $users], "All Students Got Successfully");
        //return response()->json(["user" => $users]);
    }

    public function allInstructors()
    {
        //$role = $this->roleService->getRoleByName("instrcutor");
        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'instructor');
        })->get();
        return $this->returnData('data', ['users' => $users], "All Instructors Got Successfully");
        //return response()->json(["user" => $users]);
    }

    /**
     * @param int $userId
     * @return User
     */
    public function show(int $userId)
    {
        $user = User::find($userId);

        return $user;
    }

    // public function  create(UserCreation $request)
    // {
    //     $user = new User();
    //     $user->username = $request->username;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->save();
    //     return response()->json(["user" => $user]);
    // }

    public function  update(UserUpdate $request)
    {
        $oldUser = $request->user();
        $user = User::find($oldUser->id);
        if (! $user)
        {
            return response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }
        $user->username = $request->username;
        if (!empty($request->email))
        {
            $user->email = $request->email;
        }
        else{
            $user->email = $oldUser->email;
        }
        if (!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }else{
            $user->password = $oldUser->password;
        }
        $user->save();

        $token = $user->createToken("APITOKEN")->plainTextToken;
        $user->api_token = $token;
        $userData = new userResource($user);

        if ($user->role->name == "student")
        {
            return $this->returnData('data',['user' => $userData],"Student Account Updated Successfully");
        }
        //return response
        return $this->returnData('data',['user' => $userData], "Instructor Account Updated Successfully");
    }

    public function  delete(int $userId): JsonResponse
    {
        $user = User::find($userId);
        if(!$user) {

            return response()->json(['status' => 'User Not Found'], ResponseAlias::HTTP_NOT_FOUND);

        } else {
                $user->delete();
            return response()->json(['status' => 'User was deleted'], ResponseAlias::HTTP_OK);

        }
    }


}
