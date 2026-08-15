<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('hello:scheduler', function () {
    $this->info('Hello from scheduler');
    Log::info('Hello from scheduler');
})->purpose('Print a hello message from the scheduler');

Schedule::command('inspire')->hourly();
Schedule::command('hello:scheduler')->everyFiveMinutes();
