<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\CreateUserRequest;
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
}
