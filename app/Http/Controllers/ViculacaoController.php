<?php

namespace App\Http\Controllers;

use App\Models\Vinculacao;
use App\Models\Vinculo;
use Illuminate\Http\Request;

class ViculacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vinculacoes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vinculacoes.create');
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
        ]);

        Vinculacao::create($request->only('nome'));

        return redirect()->route('vinculacoes.index')
            ->with('success', 'Vinculaçao criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('vinculacoes.edit',[
            'vinculacao' => Vinculacao::findOrFail($id),
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
            'nome' => 'required|max:256',
        ]);

        $vinculacao = Vinculacao::findOrfail($id);

        $vinculacao->update($request->only('nome'));

        return redirect()->route('vinculacoes.index')
            ->with('success', 'Vinculaçao editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vinculacao = Vinculacao::findOrFail($id);

        if(!count($vinculacao->vinculos)){
            $vinculacao->delete();
            return redirect()->route('vinculacoes.index')
                ->with('success', 'Vinculaçao excluído com sucesso');
        }

        return redirect()->route('vinculacoes.index')
            ->with('error', 'Vinculaçao não pode ser excluído pois existem vínculos que dependem dele');

    }

    public function select(Request $request)
    {
        $q = $request->input('search.value', '');

        $data = Vinculacao::when(
            $request->filled('search.value'), function ($query) use ($q) {
            $query->where('nome', 'like', "%{$q}%");

        });

        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => Vinculacao::count(),
            'recordsFiltered' => $data->get()->count(),
            'data' => $data->skip($request->get('start'))->take($request->get('length'))->get()->map(function ($vinculacao) {
                return [
                    'id' => $vinculacao->id,
                    'nome' => $vinculacao->nome,
                ];
            }),
        ]);
    }
}
