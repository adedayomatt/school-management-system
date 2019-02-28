@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('fee.index')}}">Fees</a></li>
	<li class="breadcrumb-item active">{{$fee->name}}</li>
@endsection
@section('content')
		<div class="fixed-operations-pane">
			<a href="{{route('fee.edit',[$fee->id])}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-pen"></i> Edit fee</a>
			<a href="{{route('fee.pay',[$fee->id])}}" class="btn btn-primary  btn-sm m-2"><i class="fa fa-hand-holding-usd"></i> New payment</a>
		</div>
		<?php $payments = $fee->payments ?>
		<div class="row">
			<div class="col-md-9">
				@include('fee.widget')
			</div>
			<div class="col-md-3">
				@include('fee.payable')
				<form action="{{route('fee.destroy',[$fee->id])}}" method="POST">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger btn-sm m-2"><i class="fa fa-ban"></i> cancel fee and all related payments</button>
			</form>

			</div>
		</div>

@endsection
