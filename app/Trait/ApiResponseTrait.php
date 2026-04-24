<?php

namespace App\Trait;

trait ApiResponseTrait
{

public function successResponse($data=null,$message=null){

$response=['success'=>true];

if(!is_null($message)){
    $response['message']=$message;
}

if(!is_null($data)){
    $response['data']=$data;
}

return response()->json($response,200);
}

public function paginatedResponse($paginator,$data=null){

if(is_null($data)){
    $data=$paginator->items();
}

return response()->json(['success'=>true,
'data'=>$data,
'pagination'=>[
'current_page'=>$paginator->currentPage(),
'last_page'=>$paginator->lastPage(),
'per_page'=>$paginator->perPage(),
'total'=>$paginator->total()
]
],200);
}

public function errorResponse($message,int $code=400,$errors=null){

$response=[
    'success'=>false,
     'message'=>$message
];

if(!is_null($errors)){
    $response['errors']=$errors;
}
return response()->json($response,$code);
}

public function validationErrors($message,$errors){
    return $this->errorResponse($message,422,$errors);
}
}
