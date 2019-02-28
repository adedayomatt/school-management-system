@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('term.index')}}">Academic terms</a></li>
    <li class="breadcrumb-item"><a href="{{route('term.show',[$term->id])}}">{{$term->session}}<sup>{{$term->term()}}</sup></a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4><i class="fa fa-graduate"></i> Update Academic Term</h4>
				</div>
				<div class="card-body">
					<form action="{{route('term.update',[$term->id])}}" method="post">
                        @csrf 
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Academic session</label>
                            <input type="text" class="form-control" name="academic_session" value="{{$term->session}}">
                        </div>

                        <div class="form-group">
                            <label for="">Term</label>
                            <select name="term" class="form-control select2">
                                <option value="1" {{$term->term == 1 ? 'selected' : ''}}>First Term</option>
                                <option value="2" {{$term->term== 2 ? 'selected' : ''}}>Second Term</option>
                                <option value="3" {{$term->term == 3 ? 'selected' : ''}}>Third Term</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Start</label>
                            <input type="date" class="form-control" name="start" value="{{$term->start->format('Y-m-d')}}">
                        </div>

                        <div class="form-group">
                            <label for="">End</label>
                            <input type="date" class="form-control" name="end" value="{{$term->end->format('Y-m-d')}}">
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>

                    </form>	
				</div>
			</div>
			
		</div>
	</div>
@endsection
