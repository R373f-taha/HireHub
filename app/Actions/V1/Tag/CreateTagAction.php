<?php

namespace App\Actions\V1\Tag;

use App\Models\V1\Tag;
class CreateTagAction{

public function execute(array $data){
return Tag::create($data);
}
}
