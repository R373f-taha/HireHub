<?php

namespace App\Actions\V1\Profile;

use App\Models\V1\Profile;
class CreateProfileAction{

public function execute(array $data){
    
return Profile::create($data);
}
}
