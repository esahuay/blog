<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>@yield('title','Default') | Panel de Usuario </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="{{ asset('css/cerulean/cerulean.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css')}}">
  </head>
  <body>
    <div class="container">
        <div class="page-header" id="banner">
            <div class="bs-docs-section clearfix">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1 id="navbar">@yield('title')</h1>
                        </div>
                        <div class="bs-component">
                            <div class="panel panel-default"> 
                                <div class="panel-body">
                                  <section>
                                    @yield('content')
                                  </section>
                                </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('plugins/jquery/js/jquery-3.0.js') }}"></script>
    <script src="{{ asset('plugins/jquery/js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('plugins/jquery/js/moment.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    @yield('js')
    @yield('scripts')
    <footer class="admin-footer">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class = "collapse navbar-collapse">
                    <p class="navbar-text"> Todos los derechos reservados & copy 2017</p>
                    <p class="navbar-text navbar-right">Reminder</p>
                </div>
            </div>
        </nav>
    </footer>

  </body>
</html>


