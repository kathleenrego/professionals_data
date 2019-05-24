<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $url = 'http://cnes2.datasus.gov.br/Mod_Profissional_XLS.asp?VCo_Unidade=2408102653982';
        $tmpfname = database_path('datas/Mod_Profissional.xls');
        file_put_contents(
            $tmpfname,
            file_get_contents($url)
        );
        $objPHPExcel = PHPExcel_IOFactory::load($tmpfname);
    }
}
