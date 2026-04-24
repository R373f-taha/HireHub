<?php

namespace App\Services\V1\Freelancer;

use App\Models\V1\Freelancer;
use Illuminate\Support\Facades\Cache;

class FilterFreelancersService{

   public function availableAndVerifiedFreelancer(){

    $freelancers=Cache::remember('availableAndVerifiedFreelancer',3600,function(){

    return  Cache::withoutOverlapping('availableAndVerifiedFreelancer-lock',function(){//withoutOverlapping)() = block + try +finally

    $data=Freelancer::with('profile')->availableAndVerifiedFreelancer()->paginate(10);

          Cache::put('availableAndVerifiedFreelancer',$data,3600);

    $sortedFreelancers=Freelancer::with('profile')->availableAndVerifiedFreelancer()->orderBy('created_at','desc')->paginate(10);

          Cache::put('availableVerifiedFreelancersSorted',$sortedFreelancers,3600);

          return $data;
    },30);
    }

    );


    return $freelancers;

}

   public function getAvailableVerifiedFreelancersSorted(){


   $freelancers=Cache::get('availableVerifiedFreelancersSorted');

   if($freelancers !=null )

    return $freelancers;

    else return $this->availableAndVerifiedFreelancer();
   }
   public function getAvailableVerifiedAndActiveFreelancers(){

    $freelancers=Cache::remember('AvailableVerifiedAndActiveFreelancers',3600,function(){

    return  Cache::withoutOverlapping('AvailableVerifiedAndActiveFreelancers-lock',function(){//withoutOverlapping)() = block + try +finally

    $data=Freelancer::activeAndVerified()->paginate(10);

          Cache::put('AvailableVerifiedAndActiveFreelancers',$data,3600);

          return $data;
    },30);
    }

    );


    return $freelancers;

}
}
