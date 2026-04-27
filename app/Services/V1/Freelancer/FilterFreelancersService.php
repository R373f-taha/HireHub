<?php

namespace App\Services\V1\Freelancer;

use App\Models\V1\Freelancer;
use Illuminate\Support\Facades\Cache;

class FilterFreelancersService{

   public function availableAndVerifiedFreelancer(){

    $freelancers=Cache::flexible('availableAndVerifiedFreelancer',[300,3600],function(){

    return Freelancer::with('profile')->availableAndVerifiedFreelancer()->paginate(10);

    }

    );


    return $freelancers;

}

   public function getAvailableVerifiedFreelancersSorted(){


  $freelancers=Cache::flexible('availableVerifiedFreelancersSorted',[300,3600],function(){

   return Freelancer::with('profile')->availableAndVerifiedFreelancer()->orderBy('created_at','desc')->paginate(10);

          } );

    return $freelancers;
   }
   public function getAvailableVerifiedAndActiveFreelancers(){

    $freelancers=Cache::flexible('AvailableVerifiedAndActiveFreelancers',[300,3600],function(){

    return Freelancer::activeAndVerified()->paginate(10);


    }

    );


    return $freelancers;

}
}
