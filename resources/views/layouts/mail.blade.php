<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <style>
        .text-center{
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <img src="{{asset('assets/logo.png')}}" alt="" width="50px" >
    </div>
    <div class="text-center">
        <div><strong>Little Angels Montessori School</strong></div>
        <div>Area A, World Bank Housing Estate, New Owerri Owerri, Imo State.</div>
        <div> info@littleangelsowerri.com</div>
        <div>08037269881</div>
        </div>
    </div>
    <div class="text-center">
            <hr>
    </div>

    @yield('mail-body')

    <div style="margin-top: 20px">
        Regards,
        <br>
        {{config('app.name')}}
    </div>
    <br>

</body>

</html>
