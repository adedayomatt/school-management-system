@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('term.index')}}">Academic terms</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4><i class="fa fa-graduate"></i> New Academic Term</h4>
				</div>
				<div class="card-body">
					<form action="{{route('term.store')}}" method="post">
                        @csrf 

                        <div class="form-group">
                            <label for="">Academic session</label>
                            <input type="text" class="form-control" name="academic_session" value="{{old('academic_session')}}">
                        </div>

                        <div class="form-group">
                            <label for="">Term</label>
                            <select name="term" class="form-control select2">
                                <option value="1" {{old('term') == 1 ? 'selected' : ''}}>First Term</option>
                                <option value="2" {{old('term')== 2 ? 'selected' : ''}}>Second Term</option>
                                <option value="3" {{old('term') == 3 ? 'selected' : ''}}>Third Term</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Start</label>
                            <input type="date" class="form-control" name="start" value="{{old('start')}}">
                        </div>

                        <div class="form-group">
                            <label for="">End</label>
                            <input type="date" class="form-control" name="end" value="{{old('end')}}">
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
