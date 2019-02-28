<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Receipt: {{$payment->id}}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-4.1.3/dist/css/bootstrap.min.css') }}">
    <style>
        .dot{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #01913D;
        }

    </style>
</head>

<body>

    <div class="container">
            <div class="text-center">
                <img src="{{asset('assets/logo.png')}}" alt="">
            </div>
            <div class="text-center">
                <h4>Little Angels Montessori School</h4>
                <div>
                    <small><span class="dot"></span> Area A, World Bank Housing Estate, New Owerri Owerri, Imo State.</small>
                    <br>
                    <small class="mx-2"><span class="dot"></span> 08037269881</small>
                    <small class="mx-2"><span class="dot"></span> info@littleangelsowerri.com</small>
                </div>
            </div>

            <div class="text-center">
            <hr>
                <h5>Payment Receipt</h5>
            <hr>
        </div>
    </div>

    @yield('details')

    <footer class="footer fixed-bottom">
          <div class="container text-right">
            <small class="text-muted ">printed {{ \Carbon\Carbon::now()->toDayDateTimeString() }}</small>
          </div>
    </footer>

</body>

</html>
