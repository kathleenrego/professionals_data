<?php

namespace App\Imports;

use App\Cbo;
use App\Profissional;
use App\Tipo;
use App\Vinculo;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProfissionaisImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $cbo = Cbo::firstOrCreate([
                'nome' => substr($row[4], 9),
            ]);

            $vinculo = Vinculo::firstOrCreate([
                'nome' => $row[10],
            ]);

            $tipo = Tipo::firstOrCreate([
                'nome' => $row[11],
            ]);

            Profissional::firstOrCreate([
                ['nome' => $row[0]],
                [
                    'cns' => $row[2],
                    'data_atribuicao' => Carbon::createFromFormat('d/m/Y', $row[3]),
                    'carga_horaria' => substr($row[8], 0,2),
                    'sus' => $row[9] == 'SIM' ? true : false,
                ]
            ]);
        }
    }
}