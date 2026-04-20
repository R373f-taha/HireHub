<?php

namespace App\Services\V1\User;

use App\Actions\V1\Client\CreateClientAction;
use App\Actions\V1\Freelancer\CreateFreelancerAction;
use App\Actions\V1\User\CreateUserAction;
use App\Http\Requests\V1\User\CreateUserRequest;
use App\Models\V1\Client;
use App\Models\V1\Freelancer;
use App\Models\V1\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService{
  protected $createUserAction;
    protected $createFreelancerAction;
    protected $createClientAction;
  public function __construct(
        CreateUserAction $createUserAction,
        CreateFreelancerAction $createFreelancerAction,
        CreateClientAction $createClientAction
    ) {
        $this->createUserAction = $createUserAction;
        $this->createFreelancerAction = $createFreelancerAction;
        $this->createClientAction = $createClientAction;
    }
public function register(CreateUserRequest $request){

// $action=new CreateUserAction();

$data=$request->validated();

$userData=[
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'city_id' => $data['city_id'],
        ];
$user= $this->createUserAction->execute($userData);

$token=$user->createToken('auth_token')->plainTextToken;


$responseData=match($user->role){

'admin'=>[
    'user'=>$user,
    'admin'=>$user,
    'token'=>$token,
    ],
'freelancer'=>[
    'user'=>$user,
    'freelancer'=>Freelancer::create([
    'user_id'=>$user->id,
    'is_verified'=>$data['is_verified'],
    'is_active'=>$data['is_active'],
    'location_info'=>json_encode($data['location_info'] ?? []),
]),
    'token'=>$token
],
'client'=>[
    'user'=>$user,
    'client'=>  $client=Client::create([
        'user_id'=>$user->id,
        'location_info'=>json_encode($data['location_info'] ?? []),
    ]),
    'token'=>$token
],
};
return $responseData;


}
// if($user['role']==='admin'){
// return ['user'=>$user,
// 'admin'=>$user,
// 'token'=>$token];
// }

// else if($user['role']==='freelancer'){
// $freelancer=Freelancer::create([
//     'user_id'=>$user->id,
//     'is_verified'=>$request->is_verified,
//     'is_active'=>$request->is_active,
//     'location_info'=>$request->location_info
// ]);
// return ['user'=>$user,
// 'freelancer'=>$freelancer,
// 'token'=>$token];
// }

// else if($user['role']==='client'){
//     $client=Client::create([
//         'user_id'=>$user->id,
//         'location_info'=>$request->location_info
//     ]);

// return ['user'=>$user,
// 'client'=>$client,
// 'role'=>$user['role'],
// 'token'=>$token];
// }

//  return ['invalid role'];
///}

public function login(Request $request){

$user=User::where('email',$request->email)->first();

if(!$user || !Hash::check($request->password,$user->password)){

return [
    'success' => false,
    'message' => 'Invalid credentials'
];

}

$token=$user->createToken('login_token')->plainTextToken;

    return [
        'success' => true,
        'user' => $user,
        'token' => $user->createToken('login_token')->plainTextToken
    ];

}

public function logout(Request $request){
$request->user()->currentAccessToken()->delete();
   return [
            'success' => true,
            'message' => 'Logged out successfully'
        ];
}
}
