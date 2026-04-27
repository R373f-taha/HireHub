<?php

namespace App\Services\V1\Project;

use App\Actions\V1\Project\CreateProjectAction;
use App\Http\Requests\V1\Project\CreateProjectRequest;
use App\Http\Resources\V1\Project\ProjectResource;
use App\Jobs\SendNewProjectCreatedJob;
use App\Mail\NewProjectCreatedMail;
use App\Models\V1\Project;
use Illuminate\Support\Facades\Cache;


class ProjectService{


public function index(){


    $projects=Cache::flexible('projects',[300,3600],function(){

    return Project::with('client')->where('project_status','open')->with('tags')->paginate(15);
    });


    return  ProjectResource::collection($projects);
}

public function show($id){

$project=Project::with(['offers','client','attachments'])->findOrFail($id);

$review=($project->project_status==='closed') ? $project->review: ' project status is not closed so this project doesn`t have any review ';

    return [
        'details' => [
            'project' => $project,
            'offers' => $project->offers,
            'attachments' => $project->attachments,
            'reviews' => $review
        ]
    ];
}
public function createProject(CreateProjectRequest $request,CreateProjectAction $action){

$data=$request->validated();

$data['budget']=json_encode($data['budget']);

$project=$action->execute($data);


if($project){

    SendNewProjectCreatedJob::dispatch($project)->onQueue('emails');

    Cache::forget('projects');

    return ['success'=>true,'project'=>$project,'message'=>'Project created successfully 💛😊 we will send an email notification for all freelancers'];
}

else return ['success'=>false];
}

}
