<?php

namespace App\Jobs;
use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApprovePTORequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * ID and number of days requested.
     *
     * @var User
     */
    private $userId;
    private $ptoDays;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     * @param float $ptoDays
     */
    public function __construct(int $userId ,float $ptoDays)
    {
        $this->userId = $userId;
        $this->ptoDays = $ptoDays;
    }

    /**
     * Execute the job.
     *
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->userId);
        $approve = $user->profile->pending - $this->ptoDays;
        $user->profile->pending = $approve;
        $user->profile->save();
    }
}
