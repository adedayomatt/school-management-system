@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('role.index')}}">Roles</a></li>
	<li class="breadcrumb-item active">New role</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4 class="text-center">New staff role</h4>
				</div>
				<div class="card-body">
						<form action ="{{ route('role.store') }}" method="POST">
						@csrf

						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control">
						</div>					

						<div class="form-group">
							<div class="text-center">
								<button class ="btn btn-primary" type="submit">Create role</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
@endsection
