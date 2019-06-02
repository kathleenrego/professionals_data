@extends('adminlte::page')
@section('title', 'Profissional')
@section('content_header')
    <h1>Editar Profissional</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('profissionais.update', $profissional->id) }}"  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">
                        <div class="required col-md-6 form-group{{ $errors->has('cns') ? ' has-error' : '' }}">
                            <label for="nome">CNS</label>
                            <input readonly type="number" id="cns" name="cns" value="{{$profissional->cns}}" maxlength="15"
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
                                <option value="1" {{ $profissional->sus == 1 ? 'selected' : ''}}>Sim</option>
                                <option value="0" {{ $profissional->sus == 0 ? 'selected' : ''}}>Não</option>
                            </select>
                            @if ($errors->has('cns'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('sus') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="required col-md-12 form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" value="{{$profissional->nome}}" maxlength="255"
                                   class="form-control">

                            @if ($errors->has('nome'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        <a href="{{ route('profissionais.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a edição de Profissional?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection