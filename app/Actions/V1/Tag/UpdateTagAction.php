<?php

namespace App\Actions\V1\Tag;

use App\Models\V1\Tag;

class UpdateTagAction{

public function execute(Tag $tag,$data){

 $tag->update($data);

return $tag->refresh();
}
}
