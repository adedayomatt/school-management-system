@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('fee.index')}}">Fee</a></li>
	<li class="breadcrumb-item"><a href="{{route('fee.show',[$fee->id])}}">{{$fee->name}}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-1">
			<div class="card">
				<div class="card-header">
					<h4>Edit fee: {{$fee->name}}</h4>
					<p>For: {{$fee->target}}</p>
				</div>
				<div class="card-body">
						<form action ="{{ route('fee.update',[$fee->id]) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="fee_name" class="form-control" value="{{$fee->name}}" required>
						</div>	

						<div class="form-group">
							<label for="fee_description">Fee description</label>
							<textarea name="fee_description" id="fee_description" class="form-control">{{$fee->description}}</textarea>
						</div>		

						<div class="form-group">
							<label for="">Academic Term</label>
							<select name="term" class="form-control select2" style="width: 100%">
								@foreach($_terms::orderby('created_at','desc')->get() as $term)
									<option value="{{$term->id}}">{{$term->session}} ({{$term->term()}})</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label for="ammount">Ammount</label>
							<input type="number" name="ammount" id="ammount" class="form-control" value="{{$fee->ammount}}" required>
						</div>	

						<div class="form-group">
							<label for="">Fee target : <strong>{{$fee->target}}</strong></label>
							<select class="form-control" id="fee-target" name="target">
								<option value="general" {{$fee->target == 'general' ? 'selected' : ''}}>All students</option>
								<option value="classes" {{$fee->target == 'classes' ? 'selected' : ''}}>Classes</option>
								<option value="students" {{$fee->target == 'students' ? 'selected' : ''}}>Students</option>
							</select>
						</div>

						<div class="form-group">
							<div class="text-center">
								<button class ="btn btn-primary" type="submit">Update fee</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			@include('fee.payable')
		</div>

	</div>
@endsection
