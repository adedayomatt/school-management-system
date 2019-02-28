@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Academic terms</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4><i class="fa fa-graduate"></i> Update Academic Term</h4>
				</div>
				<div class="card-body">
                    @if($terms->count() > 0)
                    <ul class="list-group">
                        @foreach($terms as $term)
                            <li class="list-group-item">
                                <a href="{{route('term.show',$term->id)}}">{{$term->session}} <sup>{{$term->term()}}</sup></a>
                                <div>
                                    <span class="mx-2">Start: <strong>{{$term->start->format('l jS \\of F Y ')}}</strong></span>
                                    <span class="mx-2">End: <strong>{{$term->end->format('l jS \\of F Y ')}}</strong></span>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                        
                    @else
                        <div class="text-center text-danger">
                            No academic term yet
                        </div>
                    @endif
				</div>
			</div>
			
		</div>
	</div>
@endsection
