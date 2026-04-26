<?php

namespace App\Actions\V1\Review;

use App\Models\V1\Review;

class CreateReviewAction{

public function execute(array $data){

return Review::create($data);
}
}
