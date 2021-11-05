<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\AdvertiserNotification;
use App\Notifications\testNotification;
use App\Repositories\I\IAd;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class remainder extends Command
{
    protected $adRepo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ad:remainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IAd $adRepo)
    {
        parent::__construct();
        $this->adRepo = $adRepo;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = $this->adRepo->getNextDayAds();

        Notification::send($users, new testNotification());

        return Command::SUCCESS;
    }
}
