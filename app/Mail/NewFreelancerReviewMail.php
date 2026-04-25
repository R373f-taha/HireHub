<?php

namespace App\Mail;

use App\Models\V1\Freelancer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewFreelancerReviewMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected Freelancer $freelancer;

    protected float $freelancerAvg;

    public function __construct(Freelancer $freelancer,float $avg)
    {
    $this->freelancer=$freelancer;

    $this->freelancerAvg=$avg;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Freelancer Review Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.freelancer-review',
            with:[
                'freelancerName'=>$this->freelancer->user->name,
                'freelancerAvgRating'=>$this->freelancerAvg
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
