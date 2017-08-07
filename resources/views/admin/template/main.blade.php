
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Default') | Panel de Administracion </title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css')}}">
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
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

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