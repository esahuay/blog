
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Default') | Panel de Administracion </title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/trumbowyg/ui/trumbowyg.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LTE.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LTE.min.css') }}">
    <link rel="stylesheet" href="/plugins/fullcalendar/fullcalendar.print.css" media="print">

</head>
<body>
    @include('admin.template.partials.nav')

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class = 'panel-title'>@yield('title')</h3>
            </div>
            <div class="panel-body">
                <section>
                    @include('flash::message') <!--  Mostrar mensaje -->
                    @include('admin.template.partials.errors')
                    @yield('content')
                </section>
            </div>
        </div>
    <script src="{{ asset('plugins/jquery/js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('plugins/jquery/js/moment.js') }}"></script>
    <script src="{{ asset('plugins/jquery/js/jquery-3.0.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ asset('plugins/trumbowyg/trumbowyg.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/fullcalendar.js') }}"></script>
    @yield('js')
    @yield('scripts')
    <footer class="admin-footer">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class = "collapse navbar-collapse">
                    <p class="navbar-text"> Todos los derechos reservados &copy 2017</p>
                    <p class="navbar-text navbar-right">Codigo Facilito</p>
                </div>
            </div>
        </nav>
    </footer>
</body>
</html>