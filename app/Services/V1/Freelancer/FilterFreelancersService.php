<?php

namespace App\Services\V1\Freelancer;

use App\Models\V1\Freelancer;

class FilterFreelancersService{

   public function availableAndVerifiedFreelancer(){

    $freelancers=Freelancer::with('profile')->where('is_verified',true)->
    whereHas('profile',function($query){

    $query->where('available_mode','available');
    })->paginate(10);

    return response()->json(['success'=>true,'data'=>$freelancers]);

}

   public function getAvailableVerifiedFreelancersSorted(){

    $freelancers=Freelancer::with('profile')->where('is_verified',true)->
    whereHas('profile',function($query){

    $query->where('available_mode','available');
    })->orderBy('created_at','desc')->paginate(10);

    return response()->json(['success'=>true,'data'=>$freelancers]);

}

   public function getAvailableVerifiedAndActiveFreelancers(){

    $freelancers=Freelancer::all()->where('is_verified',true)->where('is_active',true);
//
    return response()->json(['success'=>true,'data'=>$freelancers]);

}
}
