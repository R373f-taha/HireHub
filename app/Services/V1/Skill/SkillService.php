<?php

namespace App\Services\V1\Skill;

use App\Actions\V1\City\CreateCityAction;
use App\Actions\V1\Skill\CreateSkillAction;
use App\Actions\V1\Skill\UpdateSkillAction;
use App\Http\Requests\V1\Skill\CreateSkillRequest;
use App\Http\Requests\V1\Skill\UpdateSkillRequest;
use App\Models\V1\Skill;
use Illuminate\Support\Facades\Auth;

class SkillService{

public function store(CreateSkillRequest $request,$years_of_experience){

   $action=new CreateSkillAction();

        $skill=$action->execute($request->validated());

        $skill->freelancers()->attach(Auth::user()->freelancer->id,[

            'years_of_experience'=>$years_of_experience
        ]);

     return $skill;

}
public function update($id,UpdateSkillRequest $request,$years_of_experience){

       $skill=Skill::findOrFail($id);

       $action=new UpdateSkillAction();

        $skillAfterUpdate=$action->execute($skill,$request->validated());

        $skill->freelancers()->updateExistingPivot($id,[

            'years_of_experience'=>$years_of_experience
        ]);

  return  'Skills and Experience updated successfully';


}
}
