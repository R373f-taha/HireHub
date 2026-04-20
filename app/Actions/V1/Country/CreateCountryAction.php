<?php

namespace App\Actions\V1\Country;

use App\Models\V1\Country;
class CreateCountryAction{

public function execute(array $data){
return Country::create($data);
}
}
