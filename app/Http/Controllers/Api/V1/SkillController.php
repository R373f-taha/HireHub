<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\V1\Skill\CreateSkillAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Skill\CreateSkillRequest;
use App\Http\Requests\V1\Skill\UpdateSkillRequest;
use App\Models\V1\Skill;
use App\Services\V1\Skill\SkillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $skillService;

    public function __construct(SkillService $skillService)
    {
       $this->skillService=$skillService;
    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSkillRequest $request,$years_of_experience)
    {
     return $this->skillService->store($request,$years_of_experience);

    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, $id,$years_of_experience)
    {
        return $this->skillService->update($id,$request,$years_of_experience);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
