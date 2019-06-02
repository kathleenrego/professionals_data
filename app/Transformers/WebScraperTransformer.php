<?php

namespace App\Transformers;

use App\Imports\VinculosImport;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Exception\ConnectException;

class WebScraperTransformer
{
    public function extract()
    {
        try {
            $client = new Client();

            // Definindo TIME OUT
            $guzzleClient = new \GuzzleHttp\Client(array(
                'curl' => array(
                    CURLOPT_TIMEOUT => 15,
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
        }
        catch (ConnectException $e) {

            libxml_use_internal_errors(true);

            $file = new Crawler(file_get_contents(database_path('data/Mod_Profissional.html')));

            $collection = collect([]);
            $file->filter('tr')->each(function ($node) use($collection) {
                $c= collect([]);
                $node->filter('td')->each(function (Crawler $content, $i) use($c) {
                    $c->add($content->text());
                });
                $collection->add($c);
            });
        }

        (new VinculosImport())->collection($collection);

    }
}