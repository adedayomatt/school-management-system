@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('subject.index')}}">Subjects</a> </li>
    <li class="breadcrumb-item active">{{$subject->name}}</li>
@endsection
@section('content')
@if(Auth::user()->isAdmin())
	<div class="fixed-operations-pane">
		<a href="{{route('subject.edit',[$subject->id])}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-pen"></i> Edit subject</a>
		<a href="{{ route('staff.create') }}" class="btn btn-primary btn-sm m-2"><i class="fa fa-plus"></i> New subject</a>
        <form action="{{route('subject.destroy',[$subject->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm m-2"><i class="fa fa-trash"></i> Delete subject</button>
        </form>
    </div>
    @endif
			<div class="card">
				<div class="card-header">
					<h4><i class="fa fa-book"></i> {{$subject->name}}</h4>
				</div>
				<div class="card-body">
                    @if($subject->classrooms->count() > 0)
                        <strong>Offered by {{$subject->classrooms->count()}} class(es)</strong>
                        <ul class="list-group">
                            @foreach($subject->classrooms as $class)
                                <li class="list-group-item">
                                    <a href="{{route('class.show',[$class->id])}}">{{$class->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-danger">No class is offering {{$subject->name}}</div>
                    @endif
				</div>
			</div>

@endsection
