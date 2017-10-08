    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ route('principal.index') }}" class="navbar-brand">Reminder</a>
        </div>
        @if(Auth::user('student'))
          <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Página Principal</a></li>
                <li class="dropdown">
                    <a href="{{ route('student.auth.logout') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">{{ Auth::user('student')->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="{{ route('student.auth.logout') }}">Salir</a></li>
              </ul>
            </li>
          </ul>
        @else
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="{{ route('student.auth.login') }}"> Login <span class="caret"></span></a>
                </li>
            </ul>
        @endif
      </div>
    </div>