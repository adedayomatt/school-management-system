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
		<div class="row">
			<div class="col-md-9">
				@include('fee.summary')
				@include('fee.widget', ['payments' => $fee->payments])
			</div>
			<div class="col-md-3">
				@include('fee.payable')
				@include('fee.debtors')
			</div>
		</div>

@endsection
