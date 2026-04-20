<?php

namespace App\Actions\V1\Country;

use App\Models\V1\Country;

class UpdateCountryAction{

public function execute(Country $country,$data){

return $country->update($data);
}
}
