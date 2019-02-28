@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Payments</li>
@endsection
@section('content')
<div class="fixed-operations-pane">
    @include('payment.widgets.verify')
    <a href="{{route('payment.create')}}" class="btn btn-primary btn-sm m-2"> <i class="fa fa-fa fa-hand-holding-usd"></i> New payment</a>
</div>
<div class="card">
    <div class="card-header">
        <h4>Payments</h4>
    </div>
    <div class="card-body">
        @include('payment.widgets.table')
        {!!$payments->links()!!}
    </div>
</div>
@endsection
