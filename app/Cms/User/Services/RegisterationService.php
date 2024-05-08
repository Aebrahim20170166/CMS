<?php

namespace Cms\User\Services;

use App\Http\Resources\userResource;
use Cms\Base\Traits\GeneralTrait;
use Cms\User\Models\User;
use Cms\User\Request\UserAuthentication;
use Cms\User\Request\UserCreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisterationService
{

    use GeneralTrait;
    public function store(UserCreation $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);
        $token = $user->createToken("APITOKEN")->plainTextToken;
        $user->api_token = $token;
        $userData = new userResource($user);

        if ($user->role->name == "student")
        {
            return $this->returnData('data',['user' => $userData],"Student Account Created Successfully");
        }
        //return response
        return $this->returnData('data',['user' => $userData], "Instructor Account Created Successfully");

    }

    public function login(UserAuthentication $request)
    {

        if(auth()->attempt(["email" => $request->email, "password" => $request->password])) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken("APITOKEN")->plainTextToken;
            $user->api_token = $token;

            $userData = new userResource($user);
            return $this->returnData('data',['user' => $userData], "You Are Loged In Successfully");
        }

        return response()->json(
            [
                'status' => 'No matching user found with the provided
                email and password',
                ResponseAlias::HTTP_NOT_FOUND
         ]
        );

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->returnSuccess(ResponseAlias::HTTP_OK, "User logged out successfully");
    }



}
