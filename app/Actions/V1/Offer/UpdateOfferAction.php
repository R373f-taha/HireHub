<?php

namespace App\Actions\V1\Offere;

use App\Models\V1\Offer;

class UpdateOfferAction{

public function execute(Offer $offer,$data){

return $offer->update($data);
}
}
