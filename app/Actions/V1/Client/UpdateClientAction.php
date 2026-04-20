<?php

namespace App\Actions\V1\Client;

use App\Models\V1\Client;

class UpdateClientAction{

public function execute(Client $client,$data){

 $client->update($data);

 return $client->refresh();
}
}
