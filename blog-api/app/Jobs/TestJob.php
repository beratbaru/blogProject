<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Product;
class TestJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
    )
    {
        //
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
    }
}
