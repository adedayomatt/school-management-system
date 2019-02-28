@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item active">Classes</li>
@endsection
@section('content')
	<div class="fixed-operations-pane">
		<a href="{{ route('class.create') }}" class="btn btn-primary btn-sm m-2"><i class="fa fa-plus"></i> Create new class</a>
	</div>
		<div class="card">
			<div class="card-header">
				<h4 ><i class="fa fa-chair"></i> Classes</h4>
			</div>
			<div class="card-body">
			<table class= "table table-striped table-bordered">
				<thead>
					<th>Class</th>
					<th>Students</th>
					<th>Teacher</th>
					<th>Subjects</th>
				</thead>
				<tbody>
					@if($classes->count() > 0)
						@foreach($classes as $class)
							<tr>
								<td>
									<a href="{{ route('class.show', ['slug' => $class->slug ]) }}">{{ $class->name }}</a>
								</td>
								<td>
									<span class="badge badge-secondary">{{$class->students->count()}}</span> students
								</td>
								<td>
										{!!$class->teachers()!!}
								</td>
								<td>
									@if($class->subjects->count() > 0)
										@foreach($class->subjects as $subject)
											<a href="{{route('subject.show',[$subject->id])}}">{{$subject->name}}</a>@if(!$loop->last) , @endif
										@endforeach
									@else
										<span class="text-danger">No subject offering</span>
									@endif
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<th colspan="3" class="text-center">No class yet <a href="{{route('class.create')}}">Add class</a></th>
						</tr>
					@endif
				</tbody>
			</table>
			</div>
		</div>
	</div>
	
@endsection
