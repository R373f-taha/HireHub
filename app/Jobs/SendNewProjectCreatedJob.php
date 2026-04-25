<?php

namespace App\Jobs;

use App\Mail\NewProjectCreatedMail;
use App\Models\V1\Freelancer;
use App\Models\V1\Project;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Foundation\Queue\Queueable;
use  Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNewProjectCreatedJob implements ShouldQueue
{
    //send to all freelancers

    use Queueable,Dispatchable,SerializesModels;


    public $tries=3;

    public $backoff=[10,20,30];

   protected Project $project;
    /**
     * Create a new job instance.
     */
    public function __construct(Project $project)
    {
      $this->project=$project;//->load('client.user');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

       $project=$this->project;

        Freelancer::with('user')->chunk(100,function ($freelancers) use($project){

        foreach($freelancers as $freelancer){

        $user=$freelancer?->user;

        if(!$user || !$user->email){

             Log::warning('Cannot send email for project ' . $project->id . ": freelancer or email not found... such that the email is $user->email");

             continue;
        }
     try{
        Mail::to($user->email)->send(new NewProjectCreatedMail($project));
        Log::info('Email sent successfully for project: ' .$project->id);

     }
     catch(Exception $e){
         Log::error('Failed to send email for project: ' . $project->id);

     }
    }
    });
}

}
