<?php

namespace App\Console\Commands;

use App\Service\IA\IAFunction;
use Illuminate\Console\Command;

class jobIANewFirst extends Command
{

    private $iaFunction;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobIANewFirst';

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
    public function __construct(IAFunction $iaFunction)
    {
        parent::__construct();
        $this->iaFunction = $iaFunction;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->iaFunction->renderXML();
    }
}
