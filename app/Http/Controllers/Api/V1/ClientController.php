<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\V1\Client;
use App\Services\V1\Client\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $clientService;
    public function __construct(ClientService $clientService)
    {
         $this->clientService=$clientService;
    }

    public function acceptOffer($project_id,$offer_id){

    $result=$this->clientService->acceptOffer($project_id,$offer_id);

    return response()->json($result);
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
    public function show(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
