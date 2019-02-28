@extends('layouts.receipt')

@section('details')
    <div class="text-right">
        Ref: <strong>{{$payment->ref}}</strong>
    </div>
    <br>
    <div class="text-center">
        <strong style="font-size: 16px">{{$payment->student->fullname()}}</strong>
            <br>
        Class: {{$payment->student->classroom->name}}
        <br>
        {{$payment->fee->term->session}}, {{$payment->fee->term->term()}}
    </div>
    <br>
    <strong class="heading">Fee Info</strong>
    <table border="1">
        <tr>
            <td>Fee</td>
            <th>{{$payment->fee->name}}</th>
        </tr>
        <tr>
            <td>Description</td>
            <td class="small">{{$payment->fee->description === null ? 'NA' : $payment->fee->description}}</td>
        </tr>
        <tr>
            <td>Ammount</td>
            <th>N {{number_format($payment->fee->ammount)}}</th>
        </tr>
        <tr>
            <td>Payable</td>
            <th>N {{number_format($payment->payable())}}</th>
        </tr>

    </table>
    <br>
    <strong class="heading">Payment Info</strong>
    <table border="1">
        <tr>
            <td>Paid</td>
            <th>
                N {{number_format($payment->ammount)}}
                <div class="text-right small" style="font-weight: normal; ">
                    Received: {{$payment->created_at->toDayDateTimeString()}}
                </div>
            </th>
        </tr>
        <tr>
            <td>Balance</td>
            <th>N {{number_format($payment->balance)}}</th>
        </tr>
    </table>


@endsection