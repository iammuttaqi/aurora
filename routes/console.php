<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Process\Pool;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('wip', function () {
    $pool = Process::pool(function (Pool $pool) {
        $pool->as('first')->command('git add .');
        $pool->as('second')->command('git commit -m "wip"');
        $pool->as('third')->command('git push');
    })->start(function (string $type, string $output, string $key) {
        // ...
    });

    $results = $pool->wait();

    dd($results['third']->output());
})->purpose('Run wip git command');
