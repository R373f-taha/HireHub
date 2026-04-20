<?php

namespace App\Actions\V1\City;

use App\Models\V1\City;
class CreateCityAction{

public function execute(array $data){
return City::create($data);
}
}
