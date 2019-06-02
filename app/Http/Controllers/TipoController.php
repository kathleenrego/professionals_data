<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tipos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipos.create');
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

        Tipo::create($request->only('nome'));

        return redirect()->route('tipos.index')
            ->with('success', 'Tipo criado com sucesso');
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
        return view('tipos.edit',[
            'tipo' => Tipo::findOrFail($id),
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

        $tipo = Tipo::findOrfail($id);

        $tipo->update($request->only('nome'));

        return redirect()->route('tipos.index')
            ->with('success', 'Tipo editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);

        if(!count($tipo->vinculos)){
            $tipo->delete();
            return redirect()->route('tipos.index')
                ->with('success', 'Tipo excluído com sucesso');
        }

        return redirect()->route('tipos.index')
            ->with('error', 'Tipo não pode ser excluído pois existem vínculos que dependem dele');

    }

    public function select(Request $request)
    {
        $q = $request->input('search.value', '');

        $data = Tipo::when(
            $request->filled('search.value'), function ($query) use ($q) {
            $query->where('nome', 'like', "%{$q}%");

        });

        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => Tipo::count(),
            'recordsFiltered' => $data->get()->count(),
            'data' => $data->skip($request->get('start'))->take($request->get('length'))->get()->map(function ($tipo) {
                return [
                    'id' => $tipo->id,
                    'nome' => $tipo->nome,
                ];
            }),
        ]);
    }
}
