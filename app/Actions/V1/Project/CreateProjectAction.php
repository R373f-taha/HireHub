<?php

namespace App\Actions\V1\Project;

use App\Models\V1\Project;
class CreateProjectAction{

public function execute(array $data){
return Project::create($data);
}
}
