<?php

namespace App\Actions\V1\User;

use App\Models\V1\User;

class UpdateUserAction{

public function execute(User $user,$data){
$user->update($data);

return  $user->refresh();
}
}
