@extends('adminlte::page')

@section('title', 'Tipo')

@section('content_header')
    <h1>Criar Tipo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('tipos.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">

                            <div class="required col-md-12 form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" maxlength="255"
                                       class="form-control">

                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="{{ route('tipos.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a criação de Tipo?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection