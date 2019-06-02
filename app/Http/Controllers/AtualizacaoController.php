<?php

namespace App\Http\Controllers;

use App\Transformers\WebScraperTransformer;
use Illuminate\Http\Request;

class AtualizacaoController extends Controller
{

    public function index()
    {
        return view('atualizacoes.index');
    }

    public function extractdata()
    {
        (new WebScraperTransformer())->extract();
        return redirect()->route('vinculos.index')
            ->with('success', 'Vínculos excluídos com sucesso!');
    }
}
