@extends('layouts.dashboard')
@section('breadcrumb')
<li class="active">Staff ({{$staffs->count()}})</li>
@endsection
@section('content')
<div class="card">
	<div class="card-header">
		<h4>Staff Bin</h4>
	</div>
	<div class="card-body text-danger">
		@include('staff.widget.table');
	</div>
</div>
	

@endsection
