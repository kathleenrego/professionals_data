<?php

namespace App\Console\Commands;

use App\Imports\ProfissionaisImport;
use Goutte\Client;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
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
        try {
            $client = new Client();

            // Definindo TIME OUT
            $guzzleClient = new \GuzzleHttp\Client(array(
                'curl' => array(
                    CURLOPT_TIMEOUT => 5,
                ),
            ));
            $client->setClient($guzzleClient);

            //ACESSANDO URL
            $crawler = $client->request('GET', 'http://cnes2.datasus.gov.br/Mod_Profissional.asp?VCo_Unidade=2408102653982');

            $collection = collect([]);
            $crawler->filter('tr .gradeA')->each(function ($node) use($collection) {
                $c= collect([]);
                $node->filter('td')->each(function (Crawler $content, $i) use($c) {
                    if($i != 3)
                        $c->add($content->text());
                });
                $collection->add($c);
            });

            //POPULANDO O BANCO
            (new ProfissionaisImport())->collection($collection);
        }
        catch (ConnectException $e) {

            $this->line('Conexão indisponível!');

            libxml_use_internal_errors(true);

            Excel::import(new ProfissionaisImport(), database_path('data/Mod_Profissional.html') );
        }

        $this->line('Dados importados com sucesso!');
    }
}
