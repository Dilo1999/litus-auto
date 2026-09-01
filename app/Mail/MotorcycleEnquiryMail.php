<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MotorcycleEnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $mobile,
        public string $model,
        public ?string $showroom,
        public ?string $payment,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: '[Motorcycle Enquiry] '.$this->model.' - '.$this->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.motorcycle-enquiry',
        );
    }
}
