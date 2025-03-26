<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withSchedule(function (Schedule $schedule){
//        $schedule->call(function () {
//            \Log::info('✔ Scheduler appelé à ' . now());
//        })->everyMinute();
        $schedule->command('run:queue-once')
            ->everyMinute()
            ->withoutOverlapping()
            ->sendOutputTo(storage_path('logs/worker.log'));
    })->create();
