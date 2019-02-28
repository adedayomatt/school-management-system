@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('role.index')}}">Roles</a> </li>
<li class="breadcrumb-item active">{{$role->name}}</li>
@endsection
@section('content')
	<div class="fixed-operations-pane">
		<a href="{{route('role.edit',[$role->slug])}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-pen"></i> Edit role</a>
		<a href="{{ route('staff.create') }}" class="btn btn-primary btn-sm m-2"><i class="fa fa-plus"></i> New staff</a>
	</div>
			<div class="card">
				<div class="card-header">
					<h4><i class="fa fa-user-tag"></i> {{$role->name}}</h4>
				</div>
				<div class="card-body">
					<?php $staffs = $role->staff ?>
					@include('staff.widgets.table')
				</div>
			</div>

@endsection
