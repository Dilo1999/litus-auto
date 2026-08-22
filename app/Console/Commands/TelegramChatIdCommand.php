<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TelegramChatIdCommand extends Command
{
    protected $signature = 'telegram:chat-id';

    protected $description = 'List Telegram chat IDs from recent bot updates (use after messaging each group)';

    public function handle(): int
    {
        $token = (string) config('services.telegram.bot_token');

        if ($token === '') {
            $this->error('TELEGRAM_BOT_TOKEN or TELEGRAM_PARTS_BOT_TOKEN is not set in .env');

            return self::FAILURE;
        }

        $response = Http::timeout(15)
            ->withOptions(['verify' => (bool) config('services.telegram.verify_ssl', true)])
            ->get("https://api.telegram.org/bot{$token}/getUpdates");

        if ($response->failed()) {
            $this->error('Telegram API request failed: '.$response->body());

            return self::FAILURE;
        }

        $updates = $response->json('result', []);

        if ($updates === []) {
            $this->warn('No updates found.');
            $this->line('1. Create a Telegram group');
            $this->line('2. Add @LITUS_PARTS_BOT to the group');
            $this->line('3. Send any message in the group');
            $this->line('4. Run this command again');

            return self::FAILURE;
        }

        $this->info('Recent chats:');

        $seen = [];

        foreach ($updates as $update) {
            $chat = $update['message']['chat']
                ?? $update['my_chat_member']['chat']
                ?? $update['channel_post']['chat']
                ?? null;

            if (! $chat) {
                continue;
            }

            $id = (string) ($chat['id'] ?? '');
            if ($id === '' || isset($seen[$id])) {
                continue;
            }

            $seen[$id] = true;

            $title = $chat['title'] ?? $chat['username'] ?? $chat['first_name'] ?? 'Unknown';
            $type = $chat['type'] ?? 'unknown';

            $this->line("- {$title} ({$type}): {$id}");
        }

        $this->newLine();
        $this->info('Use TELEGRAM_PARTS_CHAT_ID for the parts group.');
        $this->info('Use TELEGRAM_SERVICE_CHAT_ID for the service group.');

        return self::SUCCESS;
    }
}
