<?php

namespace App\Services\V1\Profile;

use App\Actions\V1\Profile\CreateProfileAction;
use App\Actions\V1\Profile\UpdateProfileAction;
use App\Http\Requests\V1\Profile\UpdateProfileRequest;
use App\Models\V1\Profile;
use Exception;
use Illuminate\Http\Request;

class ProfileService{


public function update(UpdateProfileRequest $request,$id){

    $profile=Profile::findOrFail($id);

    $action=new UpdateProfileAction();


    if(!$profile){
        throw new Exception('Failed to create project');
    }
    // var_dump($request->all());
    $newProfile=$action->execute($profile,$request->validated());

    return $newProfile;


}
}
