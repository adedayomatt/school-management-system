@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('fee.index')}}">Fee</a></li>
	<li class="breadcrumb-item active">New fee</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
					<h4>New fee </h4>
				</div>
				<div class="card-body">
						<form action ="{{ route('fee.store') }}" method="POST">
						@csrf

						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="fee_name" class="form-control" value="{{old('fee_name')}}" required>
						</div>	

						<div class="form-group">
							<label for="fee_description">Fee description</label>
							<textarea name="fee_description" id="fee_description" class="form-control">{{old('fee_description')}}</textarea>
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
							<label for="">Fee target</label>
							<select class="form-control" id="fee-target" name="target">
								<option value="general">All students</option>
								<option value="classes">Selected classes</option>
								<option value="students">Selected students</option>
							</select>
						</div>

							<div class="form-group target-selection  my-2" id="classes-selection" style="display: none">
								<label for="">select classes</label>
								<select name="classes[]" class="form-control select2" multiple style="width: 100%">
									@foreach($_classes::all() as $class)
										<option value="{{$class->id}}">{{$class->name}}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group  target-selection my-2" id="students-selection" style="display: none">
									<label for="">select students</label>
									<select name="students[]" class="form-control select2" multiple  style="width: 100%">
										@foreach($_students::all() as $student)
											<option value="{{$student->id}}">{{$student->fullname()}}</option>
										@endforeach
									</select>
							</div>
	

						<div class="form-group">
							<label for="ammount">Ammount</label>
							<input type="number" name="ammount" id="ammount" class="form-control" value="{{old('ammount')}}" required>
						</div>	


						<div class="form-group">
							<div class="text-center">
								<button class ="btn btn-primary" type="submit">Create fee</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
@endsection

@section('script')
	<script>
       $('select#fee-target').change(function(){
			$('.target-selection').hide();
           if($(this).val() == 'classes')
           {
			   $('.target-selection#classes-selection').show();
           }
		   else if($(this).val() == 'students'){
			   $('.target-selection#students-selection').show();
           }
		 
       });
    </script>
@endsection
