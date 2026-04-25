<?php

namespace App\Jobs;

use App\Mail\NewOfferRejectedMail;
use App\Models\V1\Freelancer;
use App\Models\V1\Offer;
use App\Models\V1\Project;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Foundation\Queue\Queueable;
use  Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOfferRejectedJob implements ShouldQueue
{
    use Queueable,Dispatchable,SerializesModels;

    //send to each rejected freelancer
    public $tries=3;

    public $backoff=[10,20,30];
  protected Freelancer $freelancer;

    protected Offer $offer;

    protected Project $project;
    /**
     * Create a new job instance.
     */

    public function __construct(Freelancer $freelancer,Offer $offer,Project $project)
    {
        $this->freelancer=$freelancer;
        $this->offer=$offer;
        $this->project=$project;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user=$this->freelancer?->user;

        if(!$user || !$user->email){
             Log::warning('Cannot send email for project ' . $this->offer->id . ': User or email not found');
            return;
        }
     try{
        Mail::to($user->email)->send(new NewOfferRejectedMail(
            $this->freelancer,
            $this->offer,
            $this->project

        ));
        Log::info('Email sent successfully for project: ' . $this->offer->id);

     }
     catch(Exception $e){
         Log::error('Failed to send email for project: ' . $this->offer->id);

            throw $e;

     }

    }
}
