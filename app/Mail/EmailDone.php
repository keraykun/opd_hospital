<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailDone extends Mailable
{
    use Queueable, SerializesModels;
    public $title,$name,$contact,$email;

    /**
     * Create a new message instance.
     */
    public function __construct($email,$contact,$name)
    {
        $this->title = 'BPH KIBAWE - OUT PATIENT DEPARTMENT';
        $this->email = $email;
        $this->contact = $contact;
        $this->name = $name;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'BPH KIBAWE - Appointment ( Done )',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.mailer.done', // Assuming you have a Blade view named 'email.blade.php'
            with:[
            'email' => $this->email,
            'contact' => $this->contact,
            'name' => $this->name,
            'title'=>$this->title,
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
