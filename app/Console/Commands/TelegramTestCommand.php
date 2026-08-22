<?php

namespace App\Console\Commands;

use App\Services\TelegramNotifier;
use Illuminate\Console\Command;
use Throwable;

class TelegramTestCommand extends Command
{
    protected $signature = 'telegram:test {target=service : parts or service}';

    protected $description = 'Send a test Telegram message (use on cPanel to verify bot + group setup)';

    public function handle(TelegramNotifier $notifier): int
    {
        $target = strtolower((string) $this->argument('target'));

        $this->info('bot_token_set='.(filled(config('services.telegram.bot_token')) ? 'yes' : 'no'));
        $this->info('parts_chat_id='.(config('services.telegram.parts_chat_id') ?: '(empty)'));
        $this->info('service_chat_id='.(config('services.telegram.service_chat_id') ?: '(empty)'));
        $this->info('verify_ssl='.(config('services.telegram.verify_ssl') ? 'true' : 'false'));
        $this->newLine();

        try {
            $ok = match ($target) {
                'parts' => $notifier->sendPartsInquiry([
                    'brand' => 'Honda',
                    'year' => '2024',
                    'model' => 'Test Model',
                    'category' => 'Test',
                    'parts' => 'cPanel telegram test - please ignore',
                    'name' => 'Server Test',
                    'contact' => '770000000',
                ]),
                'service' => $notifier->sendServiceAppointment([
                    'name' => 'Server Test',
                    'mobile' => '770000000',
                    'model' => 'PCX 160',
                    'reg_no' => 'TEST-001',
                    'centre' => 'Colombo',
                    'date' => now()->toDateString(),
                    'service_type' => 'General Service',
                    'notes' => 'cPanel telegram test - please ignore',
                ]),
                default => null,
            };

            if ($ok === null) {
                $this->error('Use: php artisan telegram:test parts  OR  php artisan telegram:test service');

                return self::FAILURE;
            }

            if ($ok) {
                $this->info("RESULT=SENT_OK ({$target})");
                $this->info('Check the matching Telegram group for the test message.');

                return self::SUCCESS;
            }

            $this->error("RESULT=FAILED ({$target})");
            $this->line('Check storage/logs/laravel.log for details.');

            return self::FAILURE;
        } catch (Throwable $e) {
            $this->error('RESULT=EXCEPTION');
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}
