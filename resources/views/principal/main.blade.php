<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>@yield('title','Default') | Panel de Usuario </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="{{ asset('css/cerulean/cerulean.css')}}">
    <link rel="stylesheet" href="{{ asset('css/cerulean/bootstrap.min.js') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.css') }}">
    </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ route('principal.index') }}" class="navbar-brand">Reminder</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="{{ route('admin.calendars.index') }}">Calendario</a></li>
        </ul>
      </div>
    </div>

    <hr>
    <hr>
    <hr>
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class = 'panel-title'>@yield('title')</h3>
        </div>
        <div class="panel-body">
          <section>
                      @yield('content')
          </section>
        </div>
      </div>
    </div>    
    <script src="{{ asset('plugins/jquery/js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('plugins/jquery/js/moment.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/fullcalendar.js') }}"></script>
    @yield('js')
    @yield('scripts')
    <footer class="admin-footer">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class = "collapse navbar-collapse">
                    <p class="navbar-text"> Todos los derechos reservados &copy 2017</p>
                    <p class="navbar-text navbar-right">Reminder</p>
                </div>
            </div>
        </nav>
    </footer>

  </body>
</html>
