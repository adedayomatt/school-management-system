@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('payments')}}">Payments</a></li>
	<li class="breadcrumb-item active">New payment</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4 class="text-center">New payment</h4>
				</div>
				<div class="card-body">
					@if(isset($fee))
						<div class="text-center">
							For: <strong><a href="{{route('fee.show',[$fee->id])}}">{{$fee->name}}</a> - &#8358; {{number_format($fee->ammount)}}</strong> 
						</div>
					@endif
					@if(isset($student))
						<div>
							Student: <strong><a href="{{route('student.show',[$student->id])}}">{{$student->fullname()}}</a></strong>
						</div>
					@endif
					@if(isset($fee) && isset($student))
					<div>
						Paid: <strong>{{$student->aggregatePayment($fee->id)}}</strong>
					</div>
					<div>
						Outstanding: <strong>{{$student->balanceOf($fee->id)}}</strong>
					</div>
					@endif
					
                    @include('payment.widgets.form')
				</div>
			</div>
			
		</div>
	</div>
@endsection
