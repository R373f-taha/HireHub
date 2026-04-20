<?php

namespace App\Actions\V1\Skill;

use App\Models\V1\Skill;

class UpdateSkillAction{

public function execute(Skill $skill,$data){

return $skill->update($data);
}
}
