<?php

namespace App\Mail;

use App\Models\V1\Freelancer;
use App\Models\V1\Offer;
use App\Models\V1\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOfferRejectedMail extends Mailable
{
    use Queueable, SerializesModels;
    public Freelancer $freelancer;

    public Offer $offer;

    public Project $project;
    public function __construct(Freelancer $freelancer ,Offer $offer,Project $project)
    {
        $this->freelancer=$freelancer;
        $this->offer=$offer;
        $this->project=$project;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📢 Update on Your Offer - HireHub',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.offer-rejected',
            with:[
                'freelancerName'=>$this->freelancer->user->name,
                'projectTitle'=>$this->project->title,
                'offerAmount'=> $this->offer->proposed_amount,
                'projectId'=>$this->project->id,
                'clientName'=>$this->project->client->user->name,
                'rejectedAt'=>now()
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
