<?php

namespace App\Actions\V1\Offer;

use App\Models\V1\Offer;
class CreateOfferAction{

public function execute(array $data){
return Offer::create($data);
}
}
