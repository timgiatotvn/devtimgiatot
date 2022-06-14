<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Service\Admins\ArticleService;
use App\Service\Api\ApiCrawlerCategoryService;
use Illuminate\Console\Command;

class jobKeywordProductsMapCrawlerData extends Command
{
    private $articleFunction;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:jobKeywordProductsMapCrawlerData';

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
    public function __construct(ArticleService $articleFunction)
    {
        parent::__construct();
        $this->articleFunction = $articleFunction;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->articleFunction->mapProductsToArticle();
    }
}
