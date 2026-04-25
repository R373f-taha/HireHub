<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\CreateUserRequest;
use App\Http\Requests\V1\User\LoginRequest;
use App\Services\V1\User\UserService;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){

    $this->userService=$userService;

    }
    public function register(CreateUserRequest $request){

   $res= $this->userService->register($request);

   return $this->successResponse(data:$res);

    }

   public function login(LoginRequest $request)
    {
        $result = $this->userService->login($request);

        if (!$result['success']) {
            return $this->errorResponse(

                message:  $result['message']
           ,code: 401);
        }

        return $this->successResponse(

            data:$result['data']
        );
    }


    public function logout(Request $request)
    {
        $result = $this->userService->logout($request);
        return response()->json($result);
    }
}
