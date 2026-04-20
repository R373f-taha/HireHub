<?php

namespace App\Actions\V1\Skill;

use App\Models\V1\Skill;
class CreateSkillAction{

public function execute(array $data){
return Skill::create($data);
}
}
