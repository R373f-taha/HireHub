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

   public function __construct(ProfileService $preofileService)
   {
    $this->profileService=$preofileService;
   }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
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

       return response()->json(['success'=>true,'profile'=>$newProfile]);
       }
       catch(Exception $e){
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
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
