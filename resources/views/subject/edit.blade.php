@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('subject.index')}}">Subjects</a></li>
	<li class="breadcrumb-item "><a href="{{route('subject.show',[$subject->id])}}">{{$subject->name}}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4 class="text-center">Edit subject</h4>
				</div>
				<div class="card-body">
					<form action ="{{ route('subject.update',[$subject->id]) }}" method="POST">
					@csrf
					@method('PUT')

					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" value="{{$subject->name}}">
					</div>
				
					<div class="form-group">
						<label for="">update classes</label>
						<select name="classes[]" class="form-control select2" multiple style="width: 100%">
							@foreach($_classes::all() as $class)
								<option value="{{$class->id}}" {{$class->isOffering($subject->id) ? 'selected' : ''}}>{{$class->name}}</option>
							@endforeach
						</select>
					</div>				

					<div class="form-group">
						<div class="text-center">
							<button class ="btn btn-primary" type="submit">Update</button>
						</div>
					</div>
				</form>
				</div>
			</div>
			
		</div>
	</div>
@endsection

