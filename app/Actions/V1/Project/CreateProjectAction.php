<?php

namespace App\Actions\V1\Project;

use App\Models\V1\Project;
class CreateProjectAction{

public function execute(array $data){
$data['project_status'] = 'open';
return Project::create($data);
}
}
