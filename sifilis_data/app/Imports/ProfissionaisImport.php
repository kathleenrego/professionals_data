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

        foreach ($rows as $key => $row) {
            if ($key >= 4) {

                $cbo = Cbo::firstOrCreate([
                    'nome' => substr($row[4], 9),
                ]);

                $vinculo = Vinculo::firstOrCreate([
                    'nome' => $row[10],
                ]);

                $tipo = Tipo::firstOrCreate([
                    'nome' => $row[11],
                ]);

                Profissional::create([
                        'nome' => $row[0],
                        'cns' => $row[2],
                        'carga_horaria' => preg_replace("/[^0-9]/", "",$row[8]),
                        'sus' => $row[9] == 'SIM' ? true : false,
                        'tipo_id' => $tipo->id,
                        'vinculo_id' => $vinculo->id,
                        'cbo_id' => $cbo->id,
                        'data_atribuicao' => $row[3] ? Carbon::createFromFormat('d/m/Y', $row[3]) : null,
                ]);
            }
        }
    }
}