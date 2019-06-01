@extends('adminlte::page')

@section('title', 'Vínculos')

@section('content_header')
    <h1>Editar Vínculo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('vinculos.update', $vinculo->id) }}"  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="box">
                    <div class="box-header">
                        Informações Profissional
                    </div>

                    <div class="box-body">

                        <div class="required col-md-6 form-group{{ $errors->has('cns') ? ' has-error' : '' }}">
                            <label for="nome">CNS</label>
                            <input disabled type="number" id="cns" name="cns" value="{{$vinculo->profissional->cns}}" maxlength="15"
                                   class="form-control">

                            @if ($errors->has('cns'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('cns') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="required col-md-6 form-group{{ $errors->has('sus') ? ' has-error' : '' }}">
                            <label for="sus">SUS</label>
                            <select disabled class="form-control" name="sus" id="sus">
                                <option value="1" {{ $vinculo->profissional->sus == 1 ? 'selected' : ''}}>Sim</option>
                                <option value="0" {{ $vinculo->profissional->sus == 0 ? 'selected' : ''}}>Não</option>
                            </select>
                            @if ($errors->has('cns'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('sus') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="required col-md-12 form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome">Nome</label>
                            <input disabled type="text" id="nome" name="nome" value="{{$vinculo->profissional->nome}}" maxlength="255"
                                   class="form-control">

                            @if ($errors->has('nome'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="box-header">
                        Informações Vínculo
                    </div>
                    <div class="box-body">
                        <div class="required col-md-4 form-group{{ $errors->has('cbo') ? ' has-error' : '' }}">
                            <label for="sus">CBO</label>
                            <select class="form-control" name="cbo" id="cbo">
                                @foreach($cbos as $cbo)
                                    <option value="{{ $cbo->id }}" @if($cbo->id == $vinculo->cbo_id) selected @endif>
                                        {{$cbo->nome}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('cbo'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('cbo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="required col-md-4 form-group{{ $errors->has('vinculacao') ? ' has-error' : '' }}">
                            <label for="vinculacao">Vinculação</label>
                            <select class="form-control" name="vinculacao" id="vinculacao">
                                @foreach($vinculacoes as $vinculacao)
                                    <option value="{{ $vinculacao->id }}" @if($vinculacao->id == $vinculo->vinculacao_id) selected @endif>
                                        {{$vinculacao->nome}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('vinculacao'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('vinculacao') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="required col-md-4 form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                            <label for="sus">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo">
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" @if($tipo->id == $vinculo->tipo_id) selected @endif>
                                        {{$tipo->nome}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipo'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="required col-md-4 form-group{{ $errors->has('carga_horaria') ? ' has-error' : '' }}">
                            <label for="nome">Carga Horária</label>
                            <input type="number" id="carga_horaria" name="carga_horaria" value="{{$vinculo->carga_horaria}}" maxlength="255"
                                   class="form-control">

                            @if ($errors->has('carga_horaria'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('carga_horaria') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="required col-md-4 form-group{{ $errors->has('data_atribuicao') ? ' has-error' : '' }}">
                            <label for="data_atribuicao">Data de atribuição</label>
                            <input type="text" id="data_atribuicao" name="data_atribuicao" value="{{$vinculo->data_atribuicao->format('d/m/Y')}}" class="form-control" required>

                            @if ($errors->has('data_atribuicao'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('data_atribuicao') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        <a href="{{ route('vinculos.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a edição de vínculo?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>
        $(document).ready(function() {

            let options = {
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                removeMaskOnSubmit: true
            };

            $("#data_atribuicao").datepicker(options);

            $('#cns').on('input', function(){

                $.ajax({
                    url: "{{ route('api.profissionais') }}",
                    data: { cns: this.value},
                    success: function(data){
                        if(data['nome'] != null){
                            $('#nome').val(data['nome']);
                            $('#nome').attr('readonly', true);
                            $('#sus').val(data['sus']);
                            $('#sus').attr('readonly', true);
                        } else{
                            $('#nome').val('');
                            $('#nome').attr('readonly', false);
                            $('#sus').val(1);
                            $('#sus').attr('readonly', false);
                        }

                    },
                });
            });
        });

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
    </script>
@stop