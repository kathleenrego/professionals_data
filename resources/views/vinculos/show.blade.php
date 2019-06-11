@extends('adminlte::page')

@section('title', 'Vínculos')

@section('content_header')
    <h1>Ver Vínculo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="col-md-12">
                    <div class="box-header">
                        Informações sobre o vínculo

                    </div>
                    <table class="table">
                        <tr>
                            <th class="col-md-2">Nome </th>
                            <td>{{ $vinculo->profissional->nome }}</td>
                        </tr>
                        <tr>
                            <th class="col-md-2">CNS</th>
                            <td>{{ $vinculo->profissional->cns}}</td>
                        </tr>
                        <tr>
                            <th class="col-md-2">Data Atribuição </th>
                            <td>{{ $vinculo->data_atribuicao->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th class="col-md-2">CBO</th>
                            <td>{{ $vinculo->cbo->nome}}</td>
                        </tr>
                        <tr>
                            <th class="col-md-2">Carga Horária</th>
                            <td>{{ $vinculo->carga_horaria }}</td>
                        </tr>
                        <tr>
                            <th class="col-md-2">SUS</th>
                            <td>{{ $vinculo->profissional->sus ? 'SIM' : 'NÃO'}}</td>
                        </tr>
                        <tr>
                            <th class="col-md-2">Vinculação </th>
                            <td>{{ $vinculo->vinculacao->nome }}</td>
                        </tr>
                        <tr>
                            <th class="col-md-2">Tipo</th>
                            <td>{{ $vinculo->tipo->nome}}</td>
                        </tr>

                    </table>
                </div>
                <div class="box-footer">
                    <a href="{{ route('vinculos.index') }}" class="btn btn-xs btn-primary pull-right">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
