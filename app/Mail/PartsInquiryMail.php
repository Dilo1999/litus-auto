<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PartsInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $brand,
        public ?string $year,
        public ?string $model,
        public ?string $category,
        public ?string $parts,
        public string $name,
        public string $contact,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: '[Parts Inquiry] ' . $this->brand . ($this->model ? ' - ' . $this->model : ''),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.parts-inquiry',
        );
    }
}
