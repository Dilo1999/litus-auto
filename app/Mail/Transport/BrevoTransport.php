<?php

namespace App\Mail\Transport;

use Illuminate\Support\Facades\Http;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\MessageConverter;

class BrevoTransport extends AbstractTransport
{
    public function __construct(
        protected string $apiKey,
        protected bool $verifySsl = true,
    ) {
        parent::__construct();
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $payload = [
            'sender' => $this->formatAddress(head($email->getFrom())),
            'to' => $this->formatAddresses($email->getTo()),
            'subject' => (string) $email->getSubject(),
        ];

        if ($cc = $this->formatAddresses($email->getCc())) {
            $payload['cc'] = $cc;
        }

        if ($bcc = $this->formatAddresses($email->getBcc())) {
            $payload['bcc'] = $bcc;
        }

        if ($replyTo = $this->formatAddresses($email->getReplyTo())) {
            $payload['replyTo'] = $replyTo[0];
        }

        $html = $email->getHtmlBody();
        $text = $email->getTextBody();

        if (filled($html)) {
            $payload['htmlContent'] = $html;
        }

        if (filled($text)) {
            $payload['textContent'] = $text;
        }

        if (! isset($payload['htmlContent']) && ! isset($payload['textContent'])) {
            $payload['textContent'] = '(empty message)';
        }

        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])
            ->withOptions(['verify' => $this->verifySsl])
            ->timeout(30)
            ->post('https://api.brevo.com/v3/smtp/email', $payload);

        if ($response->failed()) {
            $body = $response->json('message')
                ?? $response->body()
                ?? 'Unknown Brevo error';

            throw new TransportException(
                'Brevo API request failed (HTTP '.$response->status().'): '.$body,
                $response->status()
            );
        }

        $messageId = (string) ($response->json('messageId') ?? '');

        if ($messageId !== '') {
            $message->getOriginalMessage()->getHeaders()->addHeader('X-Brevo-Message-ID', $messageId);
        }
    }

    /**
     * @param  list<Address>  $addresses
     * @return list<array{email: string, name?: string}>
     */
    protected function formatAddresses(array $addresses): array
    {
        return array_values(array_filter(array_map(
            fn (?Address $address): ?array => $this->formatAddress($address),
            $addresses
        )));
    }

    /**
     * @return array{email: string, name?: string}|null
     */
    protected function formatAddress(?Address $address): ?array
    {
        if (! $address) {
            return null;
        }

        $payload = ['email' => $address->getAddress()];
        $name = trim((string) $address->getName());

        if ($name !== '') {
            $payload['name'] = $name;
        }

        return $payload;
    }

    public function __toString(): string
    {
        return 'brevo';
    }
}
