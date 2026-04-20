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
     $allData=$this->projectService->index();

     return response()->json(['success'=>true,'data'=>$allData]);
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

        return response()->json($project);

    }
    catch(Exception $e){
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $project=$this->projectService->show($id);

       return response()->json(['success'=>true,'project'=>$project]);
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
