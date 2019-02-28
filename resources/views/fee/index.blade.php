@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Fees</li>
@endsection
@section('content')
	<div class="fixed-operations-pane">
		<a href="{{ route('fee.create') }}" class="btn btn-primary btn-sm m-2"><i class="fa fa-plus"></i> Create new fee</a>
	</div>
			<div class="card">
				<div class="card-header">
					<h4><i class="fas fa-file-invoice"></i> Student fees</h4>
				</div>
				<div class="card-body">
					<table class= "table table-striped table-bordered">
						<thead>
							<th>Fee</th>
							<th>Description</th>
							<th>Ammount</th>
							<th></th>
						</thead>

						<tbody>
							@if($fees->count() > 0)
								@foreach($fees as $fee)
									<tr>
										<td>{{ $fee->name }}</td>
										<td>{{$fee->description}}</td>
										<td>{{number_format($fee->ammount)}}</td>
										<td>
											<p>
												{{$fee->payments->count()}} payments record found
												<a href="{{route('fee.show',[$fee->id])}}" class="btn btn-primary btn-sm"> view payments</a>
											</p>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="5" class="text-center text-danger">No fee created yet </th>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>

	

@endsection
