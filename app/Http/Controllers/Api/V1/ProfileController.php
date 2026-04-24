<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\V1\Profile\CreateProfileAction;
use App\Actions\V1\Profile\UpdateProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Profile\UpdateProfileRequest;
use App\Models\V1\Profile;
use App\Services\V1\Profile\ProfileService;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

protected $profileService;

   public function __construct(ProfileService $profileService)
   {
    $this->profileService=$profileService;
   }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
     $profilesWithFreelancers=$this->profileService->index();

     return $this->successResponse(message:'Profiles and their freelancer owners',data:$profilesWithFreelancers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, int $id)
    {
//var_dump($request->all());


       try{
       $newProfile=$this->profileService->update($request,$id);

       return $this->successResponse(message:'profile updated successfully',data:$newProfile);
       }
       catch(Exception $e){

        return $this->errorResponse(message : 'profile updated failed',
        errors:$e->getMessage(),code: 500);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
