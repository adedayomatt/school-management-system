@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Grading</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4><i class="fa fa-cog"></i> Grading Settings</h4>
				</div>
				<div class="card-body">
					<form action="{{route('grade.settings.update')}}" method="post">
                        @csrf 
                        @method('PUT')

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Grade</th>
                                    <th>Min. Score</th>
                                    <th>Max. Score</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>{{$grade->alphabet}}</td>
                                    <td>
                                        <input type="number" name="{{$grade->alphabet}}_min" placeholder="Min score for grade {{$grade->alphabet}}" class="form-control" value="{{$grade->min}}">
                                    </td>
                                    <td>
                                        <input type="number" name="{{$grade->alphabet}}_max" placeholder="Max score for grade {{$grade->alphabet}}" class="form-control" value="{{$grade->max}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>

                    </form>	
				</div>
			</div>
			
		</div>
	</div>
@endsection
