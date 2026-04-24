<?php
namespace App\Http\Controllers\Api\V1;

use App\Actions\V1\Project\CreateProjectAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Project\CreateProjectRequest;
use App\Models\V1\Project;
use App\Services\V1\Project\ProjectService;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;
    public function __construct(ProjectService $projectService)
    {
        $this->projectService=$projectService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $projectsWithClientsWithTags=$this->projectService->index();

     return $this->successResponse(message:'All projects,clients and tags',data:$projectsWithClientsWithTags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {
        //budget =>json after validation
    try{
        $action=new CreateProjectAction();

        $project=$this->projectService->createProject($request , $action);

        return $this->successResponse(message:'Project created successfully ',data:$project);

    }
    catch(Exception $e){

         return  $this->errorResponse(message:'Project created failed',errors:$e->getMessage(),code:500);

    }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $project=$this->projectService->show($id);

       return $this->successResponse(message:"The project with offers,reviews and attachments ",data:$project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
