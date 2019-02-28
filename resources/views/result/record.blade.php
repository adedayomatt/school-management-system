@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('class.index')}}">classes</a></li>
<li class="breadcrumb-item"><a href="{{route('class.show',[$class->id])}}">{{$class->name}}</a></li>
<li class="breadcrumb-item"><a href="{{route('subject.show',[$subject->id])}}">{{$subject->name}}</a></li>
<li class="breadcrumb-item active">Results</li>
@endsection
@section('content')

<div class="row">
		<div class="col-md-10 offset-md-1">
			<div class="card">
				<div class="card-header">
				    <h4><i class="fa fa-pen"></i> Record results</h4>
                    <div>
                        <span class="mx-2">Class: {{$class->name}}</span> 
                        <span class="mx-2">Subject: {{$subject->name}}</span> 
                        <span class="mx-2">Term: {!!$_settings->currentTerm()!!}</span> 
                    </div>
				</div>
				<div class="card-body">
					<form action="{{route('result.save',[$class->id,$subject->id])}}" method="post">
                        @csrf 
                        <input type="hidden" name="term" value="{{$_settings->term->id}}">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Test Score</th>
                                    <th>Exam Score</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($class->students as $student)
                                <?php $result = $student->result($_settings->term->id,$subject->id) ?>
                                <tr>
                                    <td>{{$student->fullname()}}</td>
                                    <td>
                                        <input type="number" name="test_{{$student->id}}" placeholder="{{$student->enrollment->surname}} test score" class="form-control" value="{{$result == null ? '' : $result->test}}">
                                    </td>
                                    <td>
                                        <input type="number" name="exam_{{$student->id}}" placeholder="{{$student->enrollment->surname}} exam score" class="form-control" value="{{$result == null ? '' : $result->exam}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Record</button>
                        </div>
                    </form>	
				</div>
			</div>
			
		</div>
	</div>
    
    @endsection
