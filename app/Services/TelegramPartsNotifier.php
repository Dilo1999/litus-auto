<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramPartsNotifier
{
    public function isConfigured(): bool
    {
        return filled(config('services.telegram.parts.bot_token'))
            && filled(config('services.telegram.parts.chat_id'));
    }

    /**
     * @param  array{brand: string, year?: ?string, model?: ?string, category?: ?string, parts?: ?string, name: string, contact: string}  $data
     */
    public function sendPartsInquiry(array $data): bool
    {
        if (! $this->isConfigured()) {
            Log::warning('Telegram parts notifier is not configured.');

            return false;
        }

        $token = (string) config('services.telegram.parts.bot_token');
        $chatId = (string) config('services.telegram.parts.chat_id');

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

        $response = Http::timeout(15)
            ->withOptions(['verify' => (bool) config('services.telegram.parts.verify_ssl', true)])
            ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => implode("\n", $lines),
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ]);

        if ($response->failed()) {
            Log::error('Telegram parts inquiry failed.', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        }

        return (bool) $response->json('ok');
    }

    protected function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
