<?php

namespace App\Jobs;

use App\Models\Reviews;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReviewsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Reviews $reviews
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Log::info('Create review for post id ' . $this->reviews->posts_id);
    }
}
