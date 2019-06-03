@extends('adminlte::page')

@section('title', 'Indicadores')

@section('content_header')
    <h1>Indicadores</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-suitcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Vínculos</span>
                    <span class="info-box-number">{{\App\Models\Vinculo::all()->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Profissionais</span>
                    <span class="info-box-number">{{\App\Models\Profissional::all()->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa  fa-medkit"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">CBOs</span>
                    <span class="info-box-number">{{\App\Models\Cbo::all()->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-stethoscope"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tipos</span>
                    <span class="info-box-number">{{\App\Models\Tipo::all()->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-user-md"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Vinculações</span>
                    <span class="info-box-number">{{\App\Models\Vinculacao::all()->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @if(count(\App\Models\Vinculo::all()))
    <div class="row">
        <div class="col-xs-6">
            <div class="box box-warning">
                <div class="box-body" style="margin-bottom: 30px">

                    <div class="row">
                        <div class="col-sm-12">
                            <div id="container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="box box-warning">
                <div class="box-body" style="margin-bottom: 30px">

                    <div class="row">
                        <div class="col-sm-12">
                            <div id="container2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script>
        let cargas_horarias = []

        JSON.parse('{!! $profissionais !!}').forEach(function (keyValue) {
            if(keyValue != null) cargas_horarias.push(Object.values(keyValue));
        });

        let mappedX = [];
        let mappedY = [];

        JSON.parse('{!! $profissionais !!}').forEach(function (keyValue) {
            if(keyValue != null){
                mappedX.push(keyValue.carga_horaria);
                mappedY.push(keyValue.total);
            }
        });


        var chart = Highcharts.chart('container', {

            title: {
                text: 'Carga Horária dos Profissionais'
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Profissionais'
                },
            },
            xAxis: {
                allowDecimals: false,
                title: {
                    text: 'Carga Horária Semanal'
                },
                categories: mappedX,
            },
            colors: [ '#1aadce',
                '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a'],
            series: [{
                type: 'column',
                colorByPoint: true,
                name: 'Profissionais',
                data: cargas_horarias,
                showInLegend: false
            }],

        });

        let vinculacoes = [];

        JSON.parse('{!! $vinculacoes !!}').forEach(function (keyValue) {
            vinculacoes.push(Object.values(keyValue));
        });

        Highcharts.chart('container2', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Vinculações'
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            colors: [
                '#77a1e5','#492970','#f28f43', '#c42525', '#a6c96a'],
            series: [{
                name: 'Profissionais',
                data: vinculacoes,
            }]
        });
    </script>
@stop