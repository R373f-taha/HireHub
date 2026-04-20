<?php

namespace App\Actions\V1\Freelancer;

use App\Models\V1\Freelancer;

class UpdateFreelancerAction{

public function execute(Freelancer $freelancer,$data){

$freelancer->update($data);

return $freelancer->refresh();
}
}
