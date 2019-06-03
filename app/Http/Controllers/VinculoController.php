<?php

namespace App\Http\Controllers;

use App\Models\Cbo;
use App\Models\Profissional;
use App\Models\Tipo;
use App\Models\Vinculacao;
use App\Models\Vinculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VinculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vinculos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vinculos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:256',
            'data_atribuicao' => 'required|date_format:"d/m/Y"',
            'cbo' => 'required',
            'tipo' => 'required',
            'vinculacao' => 'required',
            'cns' => 'required|numeric',
            'sus' => 'required|numeric',
            'carga_horaria' => 'required|numeric',
        ]);

        $profissional = Profissional::firstOrCreate(
            [   'cns' => $request->get('cns')],
            [
                'nome' => $request->get('nome'),
                'sus' => $request->get('sus'),
            ]);

        $vinculo = Vinculo::query()->updateOrCreate(
            [
                'profissional_id' => $profissional->id,
                'tipo_id' => $request->get('tipo'),
                'vinculacao_id' => $request->get('vinculacao'),
                'cbo_id' => $request->get('cbo'),
            ],[
                'carga_horaria' => $request->get('carga_horaria'),
                'data_atribuicao' => Carbon::createFromFormat('d/m/Y', $request->get('data_atribuicao')),
            ]
        );

        $profissional = $vinculo->profissional;

        $profissional->carga_horaria_total = $profissional->vinculos->sum('carga_horaria');
        $profissional->save();

        return Redirect::route('vinculos.index')
            ->with('success', 'O vínculo foi criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('vinculos.show', [
            'vinculo' => Vinculo::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('vinculos.edit', [
            'vinculo' => Vinculo::findOrFail($id),
            'cbos' => Cbo::all(),
            'vinculacoes' => Vinculacao::all(),
            'tipos' => Tipo::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data_atribuicao' => 'required|date_format:"d/m/Y"',
            'cbo' => 'required',
            'tipo' => 'required',
            'vinculacao' => 'required',
            'carga_horaria' => 'required|numeric',
        ]);

        $vinculo = Vinculo::findOrfail($id);

        $vinculo->update(
            [
                'tipo_id' => $request->get('tipo'),
                'vinculacao_id' => $request->get('vinculacao'),
                'cbo_id' => $request->get('cbo'),
                'carga_horaria' => $request->get('carga_horaria'),
                'data_atribuicao' => Carbon::createFromFormat('d/m/Y', $request->get('data_atribuicao')),
            ]
        );


        $profissional = $vinculo->profissional;

        $profissional->carga_horaria_total = $profissional->vinculos->sum('carga_horaria');
        $profissional->save();

        return Redirect::route('vinculos.index')
            ->with('success', 'O vínculo foi editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function selectCbos(Request $request)
    {
        $cbos = Cbo::when($request->has('q'), function($query) use ($request){
            $query->where('nome', 'LIKE', "%{$request->get('q')}%");
        })->get();

        return response()->json([
            'results' => $cbos->map(function ($i) {
                return [
                    'id' => $i->id,
                    'text' => "{$i->nome} ",
                ];
            })
        ]);

    }

    public function selectVinculacoes(Request $request)
    {
        $vinculacoes = Vinculacao::when($request->has('q'), function($query) use ($request){
            $query->where('nome', 'LIKE', "%{$request->get('q')}%");
        })->get();

        return response()->json([
            'results' => $vinculacoes->map(function ($i) {
                return [
                    'id' => $i->id,
                    'text' => "{$i->nome} ",
                ];
            })
        ]);

    }

    public function selectTipos(Request $request)
    {
        $tipo = Tipo::when($request->has('q'), function($query) use ($request){
            $query->where('nome', 'LIKE', "%{$request->get('q')}%");
        })->get();

        return response()->json([
            'results' => $tipo->map(function ($i) {
                return [
                    'id' => $i->id,
                    'text' => "{$i->nome} ",
                ];
            })
        ]);

    }
    public function selectProfissionais(Request $request)
    {
        $profissional = Profissional::where('cns', $request->input('cns'))->get();

        return Response()->json([
            'nome' => count($profissional) > 0 ?
                strip_tags($profissional->first()->nome) :
                null,
            'sus' => count($profissional) > 0 ?
                strip_tags($profissional->first()->sus) :
                null,
        ]);

    }

    public function select(Request $request)
    {
        $q = $request->input('search.value', '');

            $data = Vinculo::with(['tipo','vinculacao','cbo'])->when(
                $request->filled('tipoSelect'), function ($query) use ($request) {
                    return $query->where('tipo_id', $request->get('tipoSelect'));
            })->when(
                $request->filled('vinculacaoSelect'), function ($query) use ($request) {
                    return $query->where('vinculacao_id', $request->get('vinculacaoSelect'));
            })->when(
                $request->filled('cboSelect'), function ($query) use ($request) {
                    return $query->where('cbo_id', $request->get('cboSelect'));
            })->when(
                $request->filled('search.value'), function ($query) use ($q) {
                return $query->whereHas('profissional', function ($query) use ($q) {
                    $query->where('nome', 'like', "%{$q}%")->orWhere('cns', 'like', "%{$q}%");
                });
            });


        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => Vinculo::count(),
            'recordsFiltered' => $data->get()->count(),
            'data' => $data->skip($request->get('start'))->take($request->get('length'))->get()->map(function ($vinculo) {
                return [
                    'id' => $vinculo->id,
                    'nome' => $vinculo->profissional->nome,
                    'cns' => $vinculo->profissional->cns,
                    'data_atribuicao' => $vinculo->data_atribuicao ? $vinculo->data_atribuicao->format('d/m/Y') : '',
                    'cbo' => $vinculo->cbo->nome,
                    'carga_horaria' => $vinculo->carga_horaria,
                    'sus' => $vinculo->profissional->sus ? 'SIM' : 'NÃO',
                    'vinculacao' => $vinculo->vinculacao->nome ,
                    'tipo' => $vinculo->tipo->nome ,
                ];
            }),
        ]);
    }
    public function destroyMutiple(Request $request)
    {
        $checked = $request->input('id', []);
        if ($checked == null) {
            return redirect()->route('vinculos.index')
                ->with('error', 'Selecione alguma opção para deletar!');
        }
        Vinculo::whereIn("id", $checked)->delete();
        return redirect()->route('vinculos.index')
            ->with('success', 'Vínculos excluídos com sucesso!');
    }



}
