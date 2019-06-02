@extends('adminlte::page')

@section('title', 'Atualização')

@section('content_header')
    <h1>Atualização</h1>
@stop

@section('content')
    <div id="blanket"></div>
    <div id="aguarde">Aguarde...</div>

    <form method="post" action="{{ url('/atualizar') }}">
        {{csrf_field()}}
        <input type="submit" name="update" id="update" class="btn btn-theme " value="Atualizar Dados"
               onclick="javascript:document.getElementById('blanket').style.display = 'block';document.getElementById('aguarde').style.display = 'block';">
    </form>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.btn-theme').click(function(){
                $('#aguarde, #blanket').css('display','block');
            });
        });
    </script>
@stop