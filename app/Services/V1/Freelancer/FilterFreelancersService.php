<?php

namespace App\Services\V1\Freelancer;

use App\Models\V1\Freelancer;

class FilterFreelancersService{

   public function availableAndVerifiedFreelancer(){

    $freelancers=Freelancer::with('profile')->availableAndVerifiedFreelancer()->paginate(10);

    return $freelancers;

}

   public function getAvailableVerifiedFreelancersSorted(){

    $freelancers=Freelancer::with('profile')->availableAndVerifiedFreelancer()->orderBy('created_at','desc')->paginate(10);

    return $freelancers;

}

   public function getAvailableVerifiedAndActiveFreelancers(){

    $freelancers=Freelancer::activeAndVerified()->paginate(10);

    return $freelancers;

}
}
