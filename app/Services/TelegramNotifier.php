<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramNotifier
{
    public function isPartsConfigured(): bool
    {
        return $this->hasBotToken() && filled(config('services.telegram.parts_chat_id'));
    }

    public function isServiceConfigured(): bool
    {
        return $this->hasBotToken() && filled(config('services.telegram.service_chat_id'));
    }

    public function isSalesConfigured(): bool
    {
        return $this->hasBotToken() && filled(config('services.telegram.sales_chat_id'));
    }

    /**
     * @param  array{brand: string, year?: ?string, model?: ?string, category?: ?string, parts?: ?string, name: string, contact: string}  $data
     */
    public function sendPartsInquiry(array $data): bool
    {
        if (! $this->isPartsConfigured()) {
            Log::warning('Telegram parts group is not configured.');

            return false;
        }

        $lines = [
            '<b>New Parts Inquiry</b>',
            '',
            '<b>Brand:</b> '.$this->escape($data['brand']),
        ];

        if (filled($data['year'] ?? null)) {
            $lines[] = '<b>Year:</b> '.$this->escape($data['year']);
        }

        if (filled($data['model'] ?? null)) {
            $lines[] = '<b>Model:</b> '.$this->escape($data['model']);
        }

        if (filled($data['category'] ?? null)) {
            $lines[] = '<b>Category:</b> '.$this->escape($data['category']);
        }

        if (filled($data['parts'] ?? null)) {
            $lines[] = '';
            $lines[] = '<b>Parts needed:</b>';
            $lines[] = $this->escape($data['parts']);
        }

        $lines[] = '';
        $lines[] = '<b>Name:</b> '.$this->escape($data['name']);
        $lines[] = '<b>Contact:</b> '.$this->escape($data['contact']);

        return $this->sendMessage(
            (string) config('services.telegram.parts_chat_id'),
            implode("\n", $lines),
            'parts inquiry'
        );
    }

    /**
     * @param  array{name: string, mobile: string, model?: ?string, reg_no?: ?string, centre?: ?string, date?: ?string, service_type?: ?string, notes?: ?string}  $data
     */
    public function sendServiceAppointment(array $data): bool
    {
        if (! $this->isServiceConfigured()) {
            Log::warning('Telegram service group is not configured.');

            return false;
        }

        $lines = [
            '<b>New Service Appointment</b>',
            '',
            '<b>Name:</b> '.$this->escape($data['name']),
            '<b>Mobile:</b> '.$this->escape($data['mobile']),
        ];

        if (filled($data['model'] ?? null)) {
            $lines[] = '<b>Model:</b> '.$this->escape($data['model']);
        }

        if (filled($data['reg_no'] ?? null)) {
            $lines[] = '<b>Registration:</b> '.$this->escape($data['reg_no']);
        }

        if (filled($data['centre'] ?? null)) {
            $lines[] = '<b>Service centre:</b> '.$this->escape($data['centre']);
        }

        if (filled($data['date'] ?? null)) {
            $lines[] = '<b>Preferred date:</b> '.$this->escape($data['date']);
        }

        if (filled($data['service_type'] ?? null)) {
            $lines[] = '<b>Service type:</b> '.$this->escape($data['service_type']);
        }

        if (filled($data['notes'] ?? null)) {
            $lines[] = '';
            $lines[] = '<b>Notes:</b>';
            $lines[] = $this->escape($data['notes']);
        }

        return $this->sendMessage(
            (string) config('services.telegram.service_chat_id'),
            implode("\n", $lines),
            'service appointment'
        );
    }

    /**
     * @param  array{name: string, mobile: string, model: string, showroom?: ?string, payment?: ?string}  $data
     */
    public function sendMotorcycleEnquiry(array $data): bool
    {
        if (! $this->isSalesConfigured()) {
            Log::warning('Telegram sales group is not configured.');

            return false;
        }

        $lines = [
            '<b>New Motorcycle Enquiry</b>',
            '',
            '<b>Name:</b> '.$this->escape($data['name']),
            '<b>Mobile:</b> '.$this->escape($data['mobile']),
            '<b>Model:</b> '.$this->escape($data['model']),
        ];

        if (filled($data['showroom'] ?? null)) {
            $lines[] = '<b>Showroom:</b> '.$this->escape($data['showroom']);
        }

        if (filled($data['payment'] ?? null)) {
            $lines[] = '<b>Payment:</b> '.$this->escape($data['payment']);
        }

        return $this->sendMessage(
            (string) config('services.telegram.sales_chat_id'),
            implode("\n", $lines),
            'motorcycle enquiry'
        );
    }

    protected function sendMessage(string $chatId, string $text, string $context): bool
    {
        $token = (string) config('services.telegram.bot_token');

        try {
            $response = Http::timeout(20)
                ->withOptions(['verify' => (bool) config('services.telegram.verify_ssl', false)])
                ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                    'disable_web_page_preview' => true,
                ]);
        } catch (\Throwable $e) {
            Log::error("Telegram {$context} connection failed.", [
                'chat_id' => $chatId,
                'error' => $e->getMessage(),
            ]);

            return false;
        }

        if ($response->failed()) {
            Log::error("Telegram {$context} failed.", [
                'chat_id' => $chatId,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        }

        return (bool) $response->json('ok');
    }

    protected function hasBotToken(): bool
    {
        return filled(config('services.telegram.bot_token'));
    }

    protected function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
