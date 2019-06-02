<?php

namespace App\Console\Commands;

use App\Imports\VinculosImport;
use App\Transformers\WebScraperTransformer;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Exception\ConnectException;

class ExtractByWebScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:mod_profissional';

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
        (new WebScraperTransformer())->extract();
        $this->line('Dados importados com sucesso!');
    }
}
