<?php

namespace App\Actions\V1\City;

use App\Models\V1\City;

class UpdateCityAction{

public function execute(City $city,$data){

 $city->update($data);

 return $city->refresh();
}
}
