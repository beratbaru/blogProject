<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Post;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;


// Command to update post statuses
Artisan::command('posts:update-status', function () {
    $now = Carbon::now()->toDateString(); // Get today's date (YYYY-MM-DD)

    // Activate posts where activationDate <= today AND status is passive
    $activated = Post::where('activationDate', '<=', $now)
        ->where('status', 'passive')
        ->update(['status' => 'active']);

    // Deactivate posts where deactivationDate <= today AND status is active
    $deactivated = Post::where('deactivationDate', '<=', $now)
        ->where('status', 'active')
        ->update(['status' => 'passive']);

    $this->info("Activated {$activated} posts, deactivated {$deactivated} posts.");
})->purpose('Update post statuses based on activation/deactivation dates');
Schedule::command('posts:update-status')
    ->dailyAt('00:00') // Runs every day at midnight
    ->timezone(config('app.timezone')); // Respects your app's timezone

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

