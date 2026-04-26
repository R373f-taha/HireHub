<?php

namespace App\Jobs;

use App\Mail\NewFreelancerReviewMail;
use App\Models\V1\Freelancer;
use App\Models\V1\Review;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use  Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReviewsAverageJob implements ShouldQueue
{
    use Queueable,Dispatchable,SerializesModels;

    protected freelancer $freelancer;
    /**
     * Create a new job instance.
     */
    public function __construct(Freelancer $freelancer)
    {
        $this->freelancer = $freelancer->load('user'); ;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         $user=$this->freelancer?->user;

        if(!$user || !$user->email){
             Log::warning('Cannot send email for project to ' . $this->freelancer->user->name . ': Freelancer or email not found');
            return;
        }
     try{
          $avgRating  =Review::where('freelancer_id',$this->freelancer->id)->avg('freelancer_rating');

         Mail::to($user->email)->send(new NewFreelancerReviewMail(
            $this->freelancer,
           (float) $avgRating

        ));
        Log::info('Email sent successfully for project: ' . $this->freelancer->id);

     }
     catch(Exception $e){
         Log::error('Failed to send email for project: ' . $this->freelancer->user->name);

            throw $e;

     }

    }
}
