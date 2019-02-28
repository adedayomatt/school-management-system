@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Settings</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4><i class="fa fa-cog"></i> Portal Settings</h4>
				</div>
				<div class="card-body">
					<form action="{{route('portal.settings.update')}}" method="post">
                        @csrf 
                        @method('PUT')

                        <div class="form-group">
                            <label for="">Current Academic term: {!!$_settings->currentTerm()!!}</label>
                            <select name="term" class="form-control select2">
								@foreach($_terms::orderby('created_at','desc')->get() as $term)
                                	<option value="{{$term->id}}" {{$_settings->term->term == $term->id ? 'selected' : ''}}>{{$term->session}} ({{$term->term()}})</option>
								@endforeach
							</select>
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
