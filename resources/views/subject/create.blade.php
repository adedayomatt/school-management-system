@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('subject.index')}}">Subjects</a></li>
	<li class="breadcrumb-item active">New subject</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4 class="text-center">New subject</h4>
				</div>
				<div class="card-body">
						<form action ="{{ route('subject.store') }}" method="POST">
						@csrf

						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control">
						</div>	

						<div class="form-group">
								<label for="">select classes</label>
								<select name="classes[]" class="form-control select2" multiple style="width: 100%">
									@foreach($_classes::all() as $class)
										<option value="{{$class->id}}">{{$class->name}}</option>
									@endforeach
								</select>
						</div>				

						<div class="form-group">
							<div class="text-center">
								<button class ="btn btn-primary" type="submit">Add subject</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
@endsection
