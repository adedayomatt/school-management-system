<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Result: {{$student->fullname()}} - {{$term->session}}, {{$term->term()}}</title>
    <!-- Styles -->
    <style>
    body{
        line-height: 30px;
    }
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    hr{
        margin: 5px 0;    
    }
    .small{
        font-size: .5rem;
    }
#result-table{
    height: 420px;
}
        table{
            width: 100%;
        }
        
        table,tr,td{
            border-collapse: collapse;
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
        <strong>Report Sheet</strong>
        <hr>
    </div>
    <div>
        Name: <strong>{{$student->fullname()}}</strong>
        <br>
        Class: {{$results->first()->classroom->name}}
        <br>
        Session: {{$term->session}}, {{$term->term()}}
    </div>

    <div id="result-table">
        @yield('result-table')
    </div>

    <div style="margin-top: 50px">
                <hr style="color: #000;" width="300px">
                Signature, stamp & date
    </div>
    <div>
        <i>***Any alteration renders this result invalid</i>
    </div>
    <div class="container text-right">
        <span class="text-muted ">printed {{ \Carbon\Carbon::now()->toDayDateTimeString() }}</span>
    </div>

</body>

</html>
