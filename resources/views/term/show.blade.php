@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('term.index')}}">Academic terms</a></li>
    <li class="breadcrumb-item active">{{$term->session}}<sup>{{$term->term()}}</sup></li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				    <h4><i class="fa fa-graduate"></i> {{$term->session}}<sup>{{$term->term()}}</sup></h4>
				</div>
				<div class="card-body">
                    <div>
                        <span class="mx-2">Start: <strong>{{$term->start->format('l jS \\of F Y ')}}</strong></span>
                        <span class="mx-2">End: <strong>{{$term->end->format('l jS \\of F Y ')}}</strong></span>
                    </div>
					<div class="text-right">
						<a href="{{route('term.edit',[$term->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> Edit</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@endsection
