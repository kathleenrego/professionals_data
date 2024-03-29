@extends('adminlte::page')

@section('title', 'Cbos')

@section('content_header')
    <h1>Cbos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body" style="margin-bottom: 30px">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('cbos.create') }}" class="btn btn-primary">Novo Cbo</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                                <table id="table" class="table table-bordered table-striped dataTable" role="grid">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Opções</th>
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
            $("#table").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                autoWidth: true,
                ajax:{
                    url: "{{ route('cbos.json') }}",
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
                },
                bLengthChange: false,
                columns: [
                    {data: "nome"},
                    {
                        data: "id",
                        render: function (data) {
                            return "<div class=\"btn-group-vertical\">\n" +
                                "<a href=\"/cbos/" + data + "/edit\" class=\"btn btn-warning\" style=\"margin-top: 10px;\">Editar</a>\n" +
                                "                <form style=\"border-radius: 0;margin-top: 10px;display: inline-block;\" class=\"btn-group\" onclick=\"return confirm('Você tem certeza que deseja excluir esse CBO?');\" action=\"/cbos/" + data + "\" method=\"post\">\n" +
                                "                   {!! addslashes(csrf_field()) !!}" +
                                "                   {!! addslashes(method_field('DELETE')) !!}" +
                                "                <button type=\"submit\" class=\"btn btn-danger\" >Excluir</button>\n" +
                                "                </form></div>";

                        }
                    },
                ],
            });

        });


    </script>
@stop