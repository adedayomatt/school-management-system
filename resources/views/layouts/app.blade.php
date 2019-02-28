<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 
</head>

<body >

    <div id="app">

        <main class="py-4">
          <div class="container-fluid">
          <div style="margin-top: 5%">
              @yield('content')
          </div>
            
          </div>

        </main>
    </div>


    <footer class="footer fixed-bottom text-center">
          <div class="container">
            <span class="text-muted ">{{ \Carbon\Carbon::now()->toDayDateTimeString() }}</span>
          </div>
    </footer>

</body>

</html>
