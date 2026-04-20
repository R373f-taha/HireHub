<?php

namespace App\Actions\V1\User;

use App\Models\V1\User;

class CreateUserAction{

public function execute(array $data){
return User::create($data);
}
}
