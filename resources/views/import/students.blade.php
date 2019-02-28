@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item">Import</li>
	<li class="breadcrumb-item active">Staff records</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
					<h4>Import student records</h4>
				</div>
				<div class="card-body">
                    <form action="{{route('student.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            <div class="form-group">
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                            <div class="form-group text-right ml-2">
                                <input type="submit" class="btn btn-primary" value="Import">
                            </div>
                        </div>
                    </form>
                </div>
			</div>
			
		</div>
	</div>
@endsection
