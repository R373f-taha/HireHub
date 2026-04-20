<?php

namespace App\Actions\V1\Client;

use App\Models\V1\Client;
class CreateClientAction{

public function execute(array $data){
return Client::create($data);
}
}
