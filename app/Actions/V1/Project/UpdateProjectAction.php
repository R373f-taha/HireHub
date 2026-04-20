<?php

namespace App\Actions\V1\Project;

use App\Models\V1\Project;

class UpdateProjectAction{

public function execute(Project $project,$data){

$project->update($data);

return $project->refresh();
}
}
