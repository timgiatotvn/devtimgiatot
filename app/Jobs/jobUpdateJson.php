<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Config\Definition\Exception\Exception;

class jobUpdateJson implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $var;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($var)
    {
        $this->var = $var;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $file = "queue_order.json";
            if (Storage::disk("store")->exists($file)) {
                $json = Storage::disk("store")->get($file);
                $json = !empty($json) ? @json_decode($json, true) : [];

                foreach ($json as $k => $row) {
                    if ($row["is_running"] == true) {
                        unset($json[$k]);
                    }
                }

                Storage::disk("store")->put($file, @json_encode($json));
            }
        }catch (Exception $ex){
            Log::info($ex->getMessage());
        }
    }
}
