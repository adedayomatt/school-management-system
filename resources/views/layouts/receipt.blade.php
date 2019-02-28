<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Receipt: {{$payment->ref}}</title>
    <!-- Styles -->
    <style>
    body{
        font-size: .7rem;
        padding:-20px;
        margin-top: -20px;

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
    .dot{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #01913D;
        }
        table{
            width: 100%;
        }
        
        table,tr,td{
            border-collapse: collapse;
        }
        @media print 
        {
          height: 200mm;
          width: 58mm;
        }
        
        @page { size: 58mm 200mm  }
        
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
        <strong>Payment Receipt</strong>
        <hr>
    </div>

    @yield('details')

    <div style="margin-top: 50px" class="text-center">
                <hr style="color: #000;">
                Signature, stamp & date
    </div>
    <br>
    <div>
        <i>***Any alteration renders this receipt invalid</i>
    </div>

<br>
<br>
    <div class="container text-right">
        <span class="text-muted ">printed {{ \Carbon\Carbon::now()->toDayDateTimeString() }}</span>
    </div>

</body>

</html>
