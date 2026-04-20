<?php

namespace App\Actions\V1\Freelancer;

use App\Models\V1\Freelancer;
class CreateFreelancerAction{

public function execute(array $data){
return Freelancer::create($data);
}
}
