<?php

namespace App\Console\Commands;

use App\Support\IjaraRates;
use Illuminate\Console\Command;

class IjaraAuditCommand extends Command
{
    protected $signature = 'ijara:audit';

    protected $description = 'List missing Ijara rate data (model / plan / term) to complete before launch';

    public function handle(): int
    {
        $gaps = IjaraRates::gaps();

        if (! $gaps) {
            $this->info('Ijara rate data is complete.');

            return self::SUCCESS;
        }

        foreach ($gaps as $gap) {
            $this->warn($gap);
        }

        $this->error(count($gaps).' gap(s) found.');

        return self::FAILURE;
    }
}
