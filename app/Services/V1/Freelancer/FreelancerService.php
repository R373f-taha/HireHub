<?php

namespace App\Services\V1\Freelancer;

use App\Actions\V1\Offer\CreateOfferAction;
use App\Http\Requests\V1\Offer\CreateOfferRequest;
use App\Models\V1\Freelancer;
use App\Models\V1\Client;
use App\Models\V1\Offer;
use App\Models\V1\Project;

class FreelancerService{
public function index(){

    $freelancers=Freelancer::all();

    return $freelancers;
}

public function freelancerRanking(){

return Freelancer::orderByReviews()->get();
}



}
