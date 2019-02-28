@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Subjects</li>
@endsection
@section('content')
		<div class="fixed-operations-pane">
			<a href="{{ route('subject.create') }}" class="btn btn-primary btn-sm m-2"><i class="fa fa-plus"></i> New subject</a>
		</div>
			<div class="card">
				<div class="card-header">
					<h4>Subjects</h4>
				</div>
				<div class="card-body">
					@if($subjects->count() > 0)
						<ul class="list-group">
							@foreach($subjects as $subject)
								<li class="list-group-item">
									<a href="{{route('subject.show',[$subject->id])}}"><strong>{{$subject->name}}</strong></a>
									@if($subject->classrooms->count() > 0)
										<div>Offered by: 
											@foreach($subject->classrooms as $class)
												<a href="{{route('class.show',[$class->id])}}">{{$class->name}}</a>
												@if(!$loop->last), @endif
											@endforeach
										</div>
									@else
										<div class="text-danger">No class is offering {{$subject->name}}</div>
									@endif
								</li>
							@endforeach
						</ul>
					@else
						<div class="text-danger">
							No subject added yet
						</div>
					@endif
				</div>
			</div>

	

@endsection
