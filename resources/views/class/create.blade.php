@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('class.index')}}">Classes</a></li>
<li class="breadcrumb-item active">New class</li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2">
	<div class="card">
	<div class="card-header">
		<h4>New Class</h4>
	</div>
	<div class="card-body">
	<form action ="{{ route('class.store') }}" method="POST">
		@csrf
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control">
			</div>

			<div class="form-group">
				<label for="">Subjects</label>
				<select name="subjects[]" class="form-control select2" multiple style="width: 100%">
					@foreach($_subjects::all() as $subject)
						<option value="{{$subject->id}}">{{$subject->name}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group ">
				<button class ="btn btn-primary" type="submit">Save class</button>
			</div>

	</form>
	</div>
</div>
	</div>
</div>
@endsection

