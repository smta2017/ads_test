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

        $users = $adRepo->getNextDayAds();
        // $users = User::find([2,3,5]);
        // dd($users);
        Notification::send($users, new testNotification());

        // Notification::send($users, new AdvertiserNotification());
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
