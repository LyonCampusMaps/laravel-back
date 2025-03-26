<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class RunQueueOnce extends Command
{
    /**
     * @var string
     */
    protected $signature = 'run:queue-once';

    /**
     * @var string
     */
    protected $description = 'Exécute un cycle de queue:work --once';

    public function handle(): void
    {
        Log::info('🚀 Commande run:queue-once exécutée automatiquement');
        Artisan::call('queue:work --once --timeout=60 --sleep=3 --tries=3');
    }
}
