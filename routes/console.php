<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('queue:work --timeout=60 --sleep=3',function (){
    $this->info('Queue worker is running');
})->purpose('Run the queue worker')->everyMinute()->withoutOverlapping();
