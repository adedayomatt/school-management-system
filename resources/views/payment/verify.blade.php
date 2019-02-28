@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('payments')}}">Payments</a></li>
    <li class="breadcrumb-item active">Verify</li>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @include('payment.widgets.verify')
    </div>
</div>
@if(isset($ref))
    <div class="card">
        <div class="card-header">
            <h4>Verification for payment ref <i><q>{{$ref}}</q></i></h4>
        </div>
        <div class="card-body">
           @if($payment != null)
           <table class= "table table-bordered">
                <thead>
                    <th>Student</th>
                    <th>Fee</th>
                    <th>Ammount</th>
                    <th>Ammount paid</th>
                    <th>Aggregate Payment</th>
                    <th>Balance</th>
                    <th></th>
                </thead>

                <tbody>
                    <tr>
                        <td><a href="{{route('student.show',[$payment->student->id])}}">{{ $payment->student->fullname() }}</a></td>
                        <td><a href="{{route('fee.show',[$payment->fee->id])}}">{{ $payment->fee->title }}</a></td>
                        <td>{{number_format($payment->fee->ammount)}}</td>
                        <td>{{ number_format($payment->ammount) }}</td>
                        <td>{{ number_format($payment->student->aggregatePayment($payment->fee->id)) }}</td>
                        <td>{{ number_format($payment->balance) }}</td>
                        <td><a href="{{route('payment.receipt',[$payment->ref])}}" class="btn btn-success btn-sm">receipt</a></td>
                    </tr>
                </tbody>
            </table>

           @else
                <h4 class="text-danger text-center"><i class="fa fa-exclamation-triangle"></i> No payment is found with ref <u>{{$ref}}</u></h4>
           @endif
        </div>
    </div>
@endif
@endsection
