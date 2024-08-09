<?php

namespace App\Mail;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    private Posts $posts;
    
    public function __construct($posts)
    {
        $this->posts = $posts;
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(

            from: new Address('pukar.bhatta@cosys.com.np', 'Pukar Bhatta'),
            replyTo: [
                      new Address('pukar.bhatta@cosys.com.np', 'Pukar Bhatta'),
                  ],
            subject: 'Welcome Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.posts',

            with: 
            [
            'title' => $this->posts->title,
            ]

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
