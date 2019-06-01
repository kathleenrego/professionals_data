@extends('adminlte::page')

@section('title', 'Vínculos')

@section('content_header')
    <h1>Vínculos</h1>
@stop

@push('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endpush

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
                            <form action="{{ route('destroy') }}" method="post" id="removeVinculos">
                                {{ csrf_field() }}
                                {{method_field('DELETE')}}

                                <table id="table" class="table table-bordered table-striped dataTable" role="grid">
                                    <thead>
                                    <tr>
                                        <th><button class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Você tem certeza que deseja excluir esses Vínculos?');">
                                                Excluir
                                            </button></th>
                                        <th>Nome</th>
                                        <th>CNS</th>
                                        <th>Data Atribuição</th>
                                        <th>CBO</th>
                                        <th>Carga Horária</th>
                                        <th>SUS</th>
                                        <th>Vinculação</th>
                                        <th>Tipo</th>
                                        <th>Subtipo</th>
                                        <th>Opções</th>
                                    </tr>

                                    </thead>
                                </table>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {{--<script src="{{asset('js/app.js')}}"></script>--}}
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
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

            var rows_selected = [];

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
                    {data: 'id'},
                    {data: "nome"},
                    {data: "cns"},
                    {data: "data_atribuicao"},
                    {data: "cbo"},
                    {data: "carga_horaria"},
                    {data: "sus"},
                    {data: "vinculacao"},
                    {data: "tipo"},
                    {data: "subtipo"},
                    {
                        data: "id",
                        render: function (data) {
                            return "<div class=\"btn-group-vertical\">\n" +
                                "                <a class=\"btn btn-info\" style=\"border-radius: 0;margin-top: 10px;\" href=\"/vinculos/" + data + "\">Ver</a>\n" +
                                "<a href=\"/vinculos/" + data + "/edit\" class=\"btn btn-warning\" style=\"margin-top: 10px;\">Editar</a></div>";

                        }
                    },
                ],
                "columnDefs": [
                    {
                        "targets": 0,
                        "checkboxes": {
                            "selectRow": false,
                            "selectAll":false,

                        }
                    }
                ],
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

            $('#table tbody').on('click', 'input[type="checkbox"]', function(e){
                var $row = $(this).closest('tr');
                // Get row data
                var data = table.row($row).data();
                // Get row ID
                var rowId = data.id;
                // Determine whether row ID is in the list of selected row IDs
                var index = $.inArray(rowId, rows_selected);
                // If checkbox is checked and row ID is not in list of selected row IDs
                if(this.checked && index === -1){
                    rows_selected.push(rowId);
                    // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                } else if (!this.checked && index !== -1){
                    rows_selected.splice(index, 1);
                }
                if(this.checked){
                    $row.addClass('selected');
                } else {
                    $row.removeClass('selected');
                }
                // Prevent click event from propagating to parent
                e.stopPropagation();
            });
            // Lidando com o a submissão do formulário de remoção
            $('#removeVinculos').on('submit', function (e) {
                var form = this;
                // Iterate over all selected checkboxes
                $.each(rows_selected, function(index, rowId){

                    // Create a hidden element
                    $(form).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'id[]')
                            .val(rowId)
                    );
                });
            });

        });


    </script>
@stop