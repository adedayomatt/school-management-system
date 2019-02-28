@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('student.index')}}">Students</a></li>
    <li class="breadcrumb-item">Results</li>
@endsection
@section('content')

<div class="row">
		<div class="col-md-10 offset-md-1">
                <form action="" >
                    <div class="d-flex">
                        <div class="form-group mx-2">
                            <label for="">Select student</label><br>
                            <select name="student" class="form-control select2" >
                                @foreach($_students::orderby('created_at','desc')->get() as $s)
                                    <option value="{{$s->id}}" {{isset($student) && $student->id == $s->id ? 'selected' : ''}}>{{$s->fullname()}} ({{$s->classroom->name}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <label for="">Select term</label><br>
                            <select name="term" class="form-control select2" id="" style="border-radius: 3px 0px 0px 3px">
                                @foreach($_terms::orderby('created_at','desc')->get() as $t)
                                    <option value="{{$t->id}}" {{isset($term) && $term->id == $t->id ? 'selected' : ''}}>{{$t->session}} ({{$t->term()}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for=""></label>
                        <button type="submit" class="btn btn-primary" style="border-radius: 0px 3px 3px 0px"><i class="fa fa-search"></i> Get results</button>
                    </div>
                </form>
                @if(isset($results))
                    <div class="card">
                        <div class="card-header rexr">
                            <h4><i class="fa fa-paper"></i> Results</h4>
                            <p>Showing: <a href="{{route('student.show',[$student->id])}}">{{$student->fullname()}}</a> {{$term->session}}, {{$term->term()}}</p>
                        </div>
                    
                        <div class="card-body">
                            @include('result.table')
                        </div>
                    </div>
                 @endif

		</div>
	</div>
    
    @endsection
