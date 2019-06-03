<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use App\Models\Vinculacao;
use App\Models\Vinculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndicadorController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vinculacoes = Vinculacao::withCount('vinculos')->get()->map(function ($vinculacao) {
            return [
                'nome' => $vinculacao->nome,
                'count' => intval($vinculacao->vinculos_count)];
        });
        $profissionais = DB::table('profissionais')
            ->select('carga_horaria_total', DB::raw('count(*) as total'))
            ->groupBy('carga_horaria_total')
            ->get()->map(function ($query){
                if(intval($query->total)> 70 ){
                    return [
                        'carga_horaria' => $query->carga_horaria_total.' horas',
                        'total' => intval($query->total)
                    ];
                }
            });

        return view('indicadores.index', [
            'vinculacoes' => $vinculacoes,
            'profissionais' => $profissionais,
        ]);
    }
}
