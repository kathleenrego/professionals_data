<?php

namespace App\Http\Controllers;

use App\Models\Cbo;
use Illuminate\Http\Request;

class CboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cbos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cbos.create');
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

        Cbo::create($request->only('nome'));

        return redirect()->route('cbos.index')
            ->with('success', 'CBO criado com sucesso');
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
        return view('cbos.edit',[
            'cbo' => Cbo::findOrFail($id),
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

        $cbo = Cbo::findOrfail($id);

        $cbo->update($request->only('nome'));

        return redirect()->route('cbos.index')
            ->with('success', 'CBO editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cbo = Cbo::findOrFail($id);

        if(!count($cbo->vinculos)){
            $cbo->delete();
            return redirect()->route('cbos.index')
                ->with('success', 'CBO excluído com sucesso');
        }

        return redirect()->route('cbos.index')
            ->with('error', 'CBO não pode ser excluído pois existem vínculos que dependem dele');

    }

    public function select(Request $request)
    {
        $q = $request->input('search.value', '');

        $data = Cbo::when(
            $request->filled('search.value'), function ($query) use ($q) {
                $query->where('nome', 'like', "%{$q}%");

        });

        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => Cbo::count(),
            'recordsFiltered' => $data->get()->count(),
            'data' => $data->skip($request->get('start'))->take($request->get('length'))->get()->map(function ($cbo) {
                return [
                    'id' => $cbo->id,
                    'nome' => $cbo->nome,
                ];
            }),
        ]);
    }
}
