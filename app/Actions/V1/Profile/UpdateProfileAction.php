<?php

namespace App\Actions\V1\Profile;

use App\Models\V1\Profile;

class UpdateProfileAction{

public function execute(Profile $profile,$data){

$profile->update($data);

return $profile->refresh();
}
}
