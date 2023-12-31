<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    public $lead; //var di istnza per la view contenente i dati
    /**
     * Create a new message instance.
     *
     * @return void
     */


     public function __construct($_lead)//non è lead ma si chiama così con _ per prassi
    {
        $this->lead = $_lead; //i dati del form $_lead sono inseriti in public lead
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
        //presumo che ci sia indirizzo email di chi si registra
            replyTo: $this->lead->address,
            //perchè l'ho chiamato address nel form
            subject: 'New Contact',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.contact',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
