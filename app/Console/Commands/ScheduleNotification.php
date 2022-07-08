<?php

namespace App\Console\Commands;

use App\Model\Notification;
use Illuminate\Console\Command;

class ScheduleNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:pushNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'schedule push notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notifications = Notification::where('status', 2)->where('publish_at', '<=', now())->get();

        if ($notifications) {
            foreach ($notifications as $notification)
            {
                Notification::sendNotification($notification);
                $notification->status = 1;
                $notification->save();
            }
        }
    }
}
