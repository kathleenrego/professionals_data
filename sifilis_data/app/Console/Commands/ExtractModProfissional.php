<?php

namespace App\Console\Commands;

use App\Imports\CbosImport;
use App\Imports\ProfissionaisImport;
use App\Imports\TiposImport;
use App\Imports\VinculosImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;


class ExtractModProfissional extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extract:mod_profissional';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open XLS-File from URL and save';

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
//        $url = 'http://cnes2.datasus.gov.br/Mod_Profissional_XLS.asp?VCo_Unidade=2408102653982';
//        $tmpfname = database_path('data/Mod_Profissional.html');
//        file_put_contents(
//            $tmpfname,
//            file_get_contents($url)
//        );

        libxml_use_internal_errors(true);

        Excel::import(new ProfissionaisImport(), database_path('data/Mod_Profissional.html') );

    }
}
