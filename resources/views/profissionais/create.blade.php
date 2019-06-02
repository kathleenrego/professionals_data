@extends('adminlte::page')

@section('title', 'Profisional')

@section('content_header')
    <h1>Criar Profisional</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('profissionais.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">

                        <div class="required col-md-6 form-group{{ $errors->has('cns') ? ' has-error' : '' }}">
                            <label for="nome">CNS</label>
                            <input type="number" id="cns" name="cns" value="{{ old('cns') }}" maxlength="15"
                                   class="form-control">

                            @if ($errors->has('cns'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('cns') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="required col-md-6 form-group{{ $errors->has('sus') ? ' has-error' : '' }}">
                            <label for="sus">SUS</label>
                            <select class="form-control" name="sus" id="sus">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                            @if ($errors->has('cns'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('sus') }}</strong>
                                    </span>
                            @endif
                        </div>

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
                        <a href="{{ route('profissionais.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a criação de Profisional?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection