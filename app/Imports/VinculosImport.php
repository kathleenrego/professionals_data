<?php

namespace App\Imports;

use App\Models\Cbo;
use App\Models\Profissional;
use App\Models\Tipo;
use App\Models\Vinculacao;
use App\Models\Vinculo;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class VinculosImport
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $key => $row) {

            $cbo = Cbo::firstOrCreate([
                'nome' => substr($row[4], 9),
            ]);

            $vinculacao = Vinculacao::firstOrCreate([
                'nome' => $row[10],
            ]);

            $tipo = Tipo::firstOrCreate(
                ['nome' => $row[11],
                ]);

            $profissional = Profissional::firstOrCreate(
                [   'cns' => number_format($row[2], 0,'', ''),
                    'nome' => $row[0]],
                [
                    'sus' => $row[9] == 'SIM' ? true : false,
                ]
            );

            Vinculo::query()->updateOrCreate(
                [
                    'profissional_id' => $profissional->id,
                    'tipo_id' => $tipo->id,
                    'vinculacao_id' => $vinculacao->id,
                    'cbo_id' => $cbo->id,
                ],[
                    'carga_horaria' => preg_replace("/[^0-9]/", "",$row[8]),
                    'data_atribuicao' => $row[3] ? Carbon::createFromFormat('d/m/Y', $row[3]) : null,
                ]
            );

        }

        Profissional::all()->each(function ($query){
            $query->carga_horaria_total = $query->vinculos->sum('carga_horaria');
            $query->save();
        });
    }
}