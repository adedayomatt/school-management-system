@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('fee.index')}}">Fees</a></li>
    <li class="breadcrumb-item"><a href="{{route('fee.show',[$fee->id])}}">{{$fee->title}}</a></li>
	<li class="breadcrumb-item active">Pay</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4> <i class="fa fa-hand-holding-usd"></i> Paying for: {{$fee->title}}</h4>
				</div>
				<div class="card-body">
					@include('payment.widgets.form')
				</div>
			</div>
			
		</div>
	</div>
@endsection
