<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Logo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        @if(Auth::user())
             <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('admin.index') }}">Inicio <span class="sr-only">(current)</span></a></li>
                <li><a href="{{ route('admin.users.index') }}">Usuarios <span class="glyphicon glyphicon-user"></span></a></li>
                <li><a href="{{ route('students.index') }}">Estudiantes <span class="glyphicon glyphicon-user"></span></a></li>
                <li><a href="{{ route('admin.categories.index') }}">Categorias <span class="glyphicon glyphicon glyphicon-list"></a></li>
                <li><a href="{{ route('admin.calendars.index') }}">Calendario <i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                <li><a href="{{ route('admin.articles.index') }}">Anunciar <i class="fa fa-bullhorn" aria-hidden="true"></i></a></li>
                <li><a href="{{ route('admin.tags.index') }}">Salones <span class="glyphicon glyphicon-tags"></span></a></li>
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Página Principal</a></li>
                <li class="dropdown">
                    <a href="{{ route('admin.auth.logout') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.auth.logout') }}">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
        @else
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="{{ route('admin.auth.login') }}"> Login <span class="caret"></span></a>
                </li>
            </ul>
        @endif
    </div><!-- /.container-fluid -->
</nav>