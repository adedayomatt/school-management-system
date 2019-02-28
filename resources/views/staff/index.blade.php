@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item active">Staff ({{$_staffs::all()->count()}})</li>
@endsection
@section('content')
<div class="fixed-operations-pane">
		<a href="{{route('staff.create')}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-plus"></i> Add new</a>
		<a href="{{route('staff.export')}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-download"></i> Export staff records</a>
		<a href="{{route('staff.import.form')}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-upload"></i> Import staff records</a>
</div>


<div class="card">
	<div class="card-header">
		<h4><i class="fa fa-user-tie"></i> Staff</h4>
	</div>
	<div class="card-body">
		@include('staff.widgets.table')
	</div>
</div>
	

@endsection
