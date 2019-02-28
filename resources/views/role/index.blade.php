@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Roles</li>
@endsection
@section('content')
		<div class="fixed-operations-pane">
			<a href="{{ route('role.create') }}" class="btn btn-primary btn-sm m-2">New staff role</a>
			<a href="{{ route('staff.create') }}" class="btn btn-primary btn-sm m-2">New staff</a>
		</div>
			<div class="card">
				<div class="card-header">
					<h4><i class="fa fa-user-tag"></i> Staff roles</h4>
				</div>
				<div class="card-body">
					<table class= "table table-striped table-hover">
						<thead>
							<th>Role</th>
							<th>Staff</th>
						</thead>

						<tbody>
							@if($roles->count() > 0)
								@foreach($roles as $role)
									<tr>
										<td><a href="{{route('role.show',[$role->slug])}}">{{ $role->name }}</a></td>
										<td>
											@if($role->staff->count() > 0)
												<span class="badge badge-secondary">{{$role->staff->count()}}</span> staff
												<ul class="list-group">
													@foreach($role->staff as $staff)
														<li class="list-group-item"><a href="{{route('staff.show',[$staff->id])}}">{{$staff->fullname()}}</a></li>
													@endforeach
												</ul>
											@else
												<small class="text-danger">No staff for <strong>{{$role->name}}</strong> yet</small>
											@endif
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<th colspan="2" class="text-center">No role created yet <br> <a href="{{route('role.create')}}" class="btn btn-primary">Create role</a></th>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>

	

@endsection
