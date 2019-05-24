<!-- search form -->
<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Pesquisar...">
        <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
        </span>
    </div>
</form>
<!-- /.search form -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU DE NAVEGAÇÃO</li>
    {{--<li class="{{ Request::is('atendimentos*') ? 'active' : '' }}">--}}
        {{--<a href="{{ route('atendimentos.index') }}">--}}
            {{--<i class="fa fa-calendar-minus-o"></i> <span>Atendimentos</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--<li class="{{ Request::is('fisioterapias*') ? 'active' : '' }}">--}}
        {{--<a href="{{ route('fisioterapias.index') }}">--}}
            {{--<i class="fa fa-heartbeat"></i> <span>Fisioterapias</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--<li class="{{ Request::is('planos*') ? 'active' : '' }}">--}}
        {{--<a href="{{ route('planos.index') }}">--}}
            {{--<i class="fa fa-medkit"></i> <span>Planos de saúde</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--<li class="{{ Request::is('pacientes*') ? 'active' : '' }}">--}}
        {{--<a href="{{ route('pacientes.index') }}">--}}
            {{--<i class="fa fa-user-plus"></i> <span>Pacientes</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--<li class="treeview {{ Request::is('relatorio_geral*') ? 'active' : '' }}">--}}
        {{--<a href="#"><i class="fa fa-download"></i> Relatórios--}}
            {{--<span class="pull-right-container">--}}
                  {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
            {{--<li class="{{ Request::is('relatorio_geral*') ? 'active' : '' }}">--}}
                {{--<a href="{{ route('relatorio_geral') }}">Relatório geral</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}

    {{--<li class="treeview {{  Request::is('administradores*') ? 'active' : '' }}">--}}
        {{--<a href="#"><i class="fa fa-users"></i> Cadastro--}}
            {{--<span class="pull-right-container">--}}
                  {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
        {{--</a>--}}
        {{--<ul class="treeview-menu">--}}
            {{--<li class="{{ Request::is('administradores*') ? 'active' : '' }}">--}}
                {{--<a href="{{ route('administradores.index') }}">--}}
                    {{--<span>Administradores</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}
</ul>
