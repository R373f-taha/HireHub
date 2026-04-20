<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\V1\Offer\CreateOfferAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Offer\CreateOfferRequest;
use App\Models\V1\Offer;
use App\Services\V1\Offer\OfferBidService;
use App\Services\V1\Offer\OfferService;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected  $offerService;
    protected $offerBidService;

    public function __construct(OfferService $offerService,OfferBidService $offerBidService)
    {
     $this->offerService=$offerService;
     $this->offerBidService=$offerBidService;
    }
    public function index()
    {

        return $this->offerService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOfferRequest $request,CreateOfferAction $action)
    {
        $res=$this->offerService->applicationForAnOffer($request,$action);
        return response()->json($res);

    }

    /**
     * Display the specified resource.
     */
    public function show($offerId)
    {
        return $this->offerService->show($offerId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offers)
    {
        //
    }

    public function getBid($freelancerId){

    $res=$this->offerBidService->bid($freelancerId);

    return response()->json($res);

    }
}
