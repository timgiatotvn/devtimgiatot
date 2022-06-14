<?php

namespace App\Console\Commands;

use App\Service\Api\ApiCrawlerCategoryService;
use Illuminate\Console\Command;

class jobPushQueueCrawlerPostByCategoryAjax extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:jobPushQueueCrawlerPostByCategoryAjax';

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
    public function __construct(ApiCrawlerCategoryService $apiCrawlerCategoryFunction)
    {
        parent::__construct();
        $this->apiCrawlerCategoryFunction = $apiCrawlerCategoryFunction;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
