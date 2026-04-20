<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\V1\Offer\CreateOfferAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Offer\CreateOfferRequest;
use App\Models\V1\Freelancer;
use App\Services\V1\Freelancer\FilterFreelancersService;
use App\Services\V1\Freelancer\FreelancerService;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
       protected $freelancerService,$filterFreelancersService;
    public function __construct(FreelancerService $freelancerService,FilterFreelancersService $filterFreelancersService)
    {
        $this->freelancerService=$freelancerService;
        
        $this->filterFreelancersService=$filterFreelancersService;
    }

    public function submitOffer(CreateOfferRequest $request){

    $action =new CreateOfferAction();

    $res=$this->freelancerService->submitOffer($request,$action);

    return response()->json($res);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $freelancers=$this->freelancerService->index();

     return response()->json(['success'=>true,'data'=>$freelancers]);
    }

    public function availableAndVerifiedFreelancers(){

    return $this->filterFreelancersService->availableAndVerifiedFreelancer();
    }

    public function getAvailableVerifiedFreelancersSorted(){

    return $this->filterFreelancersService->getAvailableVerifiedFreelancersSorted();
    }

    public function getAvailableVerifiedAndActiveFreelancers(){

    return $this->filterFreelancersService->getAvailableVerifiedAndActiveFreelancers();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Freelancer $freelancer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Freelancer $freelancer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Freelancer $freelancer)
    {
        //
    }

}
