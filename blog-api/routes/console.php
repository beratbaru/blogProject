<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Post;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;


Artisan::command('posts:update-status', function () {
    $now = Carbon::now()->toDateString();

    $activated = Post::where('activationDate', '<=', $now)
        ->where('status', 'passive')
        ->update(['status' => 'active']);

    $deactivated = Post::where('deactivationDate', '<=', $now)
        ->where('status', 'active')
        ->update(['status' => 'passive']);

    $this->info("Activated {$activated} posts, deactivated {$deactivated} posts.");
})->purpose('Update post statuses based on activation/deactivation dates');
Schedule::command('posts:update-status')
    ->dailyAt('00:00') 
    ->timezone(config('app.timezone')); 
