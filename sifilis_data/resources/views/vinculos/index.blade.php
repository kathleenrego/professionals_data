@extends('adminlte::page')

@section('title', 'Vínculos')

@section('content_header')
    <h1>Vínculos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body" style="margin-bottom: 30px">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('vinculos.create') }}" class="btn btn-primary">Novo Vínculo</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom:3px ">
                            CBO:
                            <select name="cbo" id="cbo" data-index="0">
                            </select>
                        </div>
                        <div class="col-md-4" style="margin-bottom:3px ">
                            Vinculação:
                            <select name="cbo" id="vinculacao" data-index="0">
                            </select>
                        </div>
                        <div class="col-md-4" style="margin-bottom:3px ">
                            Tipo:
                            <select name="cbo" id="tipo" data-index="0">
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <table id="table" class="table table-bordered table-striped dataTable" role="grid">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CNS</th>
                                    <th>Data Atribuição</th>
                                    <th>CBO</th>
                                    <th>Carga Horária</th>
                                    <th>SUS</th>
                                    <th>Vinculação</th>
                                    <th>Tipo</th>
                                    <th>Subtipo</th>
                                </tr>

                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>

        $(function () {

            var cbo = $('#cbo');
            var vinculacao = $('#vinculacao');
            var tipo = $('#tipo');

            cbo.select2({
                'language': 'pt-BR',
                placeholder: 'Selecione um CBO',
                width: '100%',
                allowClear: true,
                ajax: {
                    url: '{{ route('cbos.select') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    }
                }
            });
            vinculacao.select2({
                'language': 'pt-BR',
                placeholder: 'Selecione uma Vinculação',
                width: '100%',
                allowClear: true,
                ajax: {
                    url: '{{ route('vinculacoes.select') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    }
                }
            });
            tipo.select2({
                'language': 'pt-BR',
                placeholder: 'Selecione um Tipo',
                width: '100%',
                allowClear: true,
                ajax: {
                    url: '{{ route('tipos.select') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    }
                }
            });


            var table = $("#table").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                autoWidth: true,
                ajax:{
                    url: "{{ route('vinculos.select') }}",
                    data: function (data) {
                        data.tipoSelect = tipo.val();
                        data.vinculacaoSelect = vinculacao.val();
                        data.cboSelect = cbo.val();
                    }
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
                },
                bLengthChange: false,
                columns: [
                    {data: "nome"},
                    {data: "cns"},
                    {data: "data_atribuicao"},
                    {data: "cbo"},
                    {data: "carga_horaria"},
                    {data: "sus"},
                    {data: "vinculacao"},
                    {data: "tipo"},
                    {data: "subtipo"},
                ]
            });

            tipo.on('change', function () {
                table.ajax.reload();
            });

            cbo.on('change', function () {
                table.ajax.reload();
            });

            vinculacao.on('change', function () {
                table.ajax.reload();
            });

        });


    </script>
@stop