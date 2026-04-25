<?php

namespace App\Services\V1\Project;

use App\Actions\V1\Project\CreateProjectAction;
use App\Http\Requests\V1\Project\CreateProjectRequest;
use App\Http\Resources\V1\Project\ProjectResource;
use App\Models\V1\Project;

class ProjectService{

public function index(){

    $projects=Project::with('client')->where('project_status','open')->with('tags')->paginate(15);

    return  ProjectResource::collection($projects);
}

public function show($id){

$project=Project::findOrFail($id);

$offers=$project->offers;

$attachments=$project->attachments;

if($project->project_status !== 'closed'){


$review=' project status is not closed so this project doesn`t have any review ';
}

else{

$review=$project->review;

}

return [

'details'=>[
    'project'=>$project,
    'offers'=>$offers,
    'attachments'=>$attachments,
    'reviews'=>$review
]];
}
public function createProject(CreateProjectRequest $request,CreateProjectAction $action){

$data=$request->validated();

$data['budget']=json_encode($data['budget']);

$project=$action->execute($data);

if($project)
    return ['success'=>true,'project'=>$project];

else return ['success'=>false];
}

}
