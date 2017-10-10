<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a href="{{ route('principal.index') }}" class="navbar-brand">Reminder</a>
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse" id="navbar-main" aria-expanded="false" style="height: 1px;">
      <ul class="nav navbar-nav">
        <li>
          <a href="{{ route('student.home') }}">Home</a>
        </li>
        <li>
          <a href="{{ route('student.calendar') }}">Calendar</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          @if(Auth::user('student'))
            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('student.auth.logout') }}" id="themes" aria-expanded="false">{{ Auth::user('student')->name }}<span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="{{ route('student.auth.logout') }}">Salir</a></li>
              </ul>
          @else
            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('student.auth.login') }}" id="themes" aria-expanded="false">Login<span class="caret"></span></a>
            <ul class="dropdown-menu" aria-labelledby="themes">
            </ul>
          @endif
        </li>
      </ul>

    </div>
  </div>
</div>
