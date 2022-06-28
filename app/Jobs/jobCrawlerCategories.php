<?php

namespace App\Jobs;

use App\Helpers\Helpers;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class jobCrawlerCategories implements ShouldQueue
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
        Log::info("321321321");
        echo $this->var->type_crawler;
        if($this->var->type_crawler == "ajax"){
            Helpers::curlData($this->var, env("NODE_JS_URL_AJAX") . "crawler-data");
        }else{
            Helpers::curlData($this->var, env("NODE_JS_URL") . "crawler-data");
        }
    }
}
