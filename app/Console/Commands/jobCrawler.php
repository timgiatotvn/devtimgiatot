<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Jobs\jobCrawlerCategories;
use App\Jobs\jobDemoCrawler;
use App\Service\Admins\CrawlerCategoryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class jobCrawler extends Command
{
    private $service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:jobCrawler';

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
    public function __construct(CrawlerCategoryService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = "queue_order.json";
        if (Storage::disk("store")->exists($file)) {
            $json = Storage::disk("store")->get($file);
            $json = !empty($json) ? @json_decode($json, true) : [];

            foreach ($json as $k => $row) {
                if ($row["is_running"] == true) break;
                if (!empty($row["completed_at"])) {
                    unset($json[$k]);
                } else {
                    $detail = $this->service->findById($row["id"]);
                    if (!empty($detail->id)) {
                        if (!empty($row["type"] == "first")) {
                            $json[$k]["is_running"] = true;
                            jobDemoCrawler::dispatch($detail)->delay(now()->addSeconds(2));
                        } else {
                            $json[$k]["is_running"] = true;
                            jobCrawlerCategories::dispatch($detail)->delay(now()->addSeconds(2));
                        }
                        break;
                    }
                }
            }

            Storage::disk("store")->put($file, @json_encode($json));
        }
    }
}
