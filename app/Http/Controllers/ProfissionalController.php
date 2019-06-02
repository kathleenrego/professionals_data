<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;

class ProfissionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profissionais.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profissionais.create');
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
            'cns' => 'required|numeric',
            'sus' => 'required|numeric',
        ]);

        Profissional::firstOrCreate(
            [   'cns' => $request->get('cns')],
            [
                'nome' => $request->get('nome'),
                'sus' => $request->get('sus'),
            ]);

        return redirect()->route('profissionais.index')
            ->with('success', 'Profissional criado com sucesso');
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
        return view('profissionais.edit',[
            'profissional' => Profissional::findOrFail($id),
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
            'sus' => 'required|numeric',
        ]);

        $profissional = Profissional::findOrfail($id);

        $profissional->update([
            'nome' => $request->get('nome'),
            'sus' => $request->get('sus'),
            ]);

        return redirect()->route('profissionais.index')
            ->with('success', 'profissional editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profissional = Profissional::findOrFail($id);

        if(!count($profissional->vinculos)){
            $profissional->delete();
            return redirect()->route('profissionais.index')
                ->with('success', 'profissional excluído com sucesso');
        }

        return redirect()->route('profissionais.index')
            ->with('error', 'profissional não pode ser excluído pois existem vínculos que dependem dele');

    }

    public function select(Request $request)
    {
        $q = $request->input('search.value', '');

        $data = Profissional::when(
            $request->filled('search.value'), function ($query) use ($q) {
            $query->where('nome', 'like', "%{$q}%")->orWhere('cns', 'like', "%{$q}%");

        });

        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => Profissional::count(),
            'recordsFiltered' => $data->get()->count(),
            'data' => $data->skip($request->get('start'))->take($request->get('length'))->get()->map(function ($profissional) {
                return [
                    'id' => $profissional->id,
                    'nome' => $profissional->nome,
                    'cns' => $profissional->cns,
                    'sus' => $profissional->sus ? 'SIM' : 'NÃO',
                ];
            }),
        ]);
    }
}
