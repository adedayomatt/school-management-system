@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Enrollments</li>
@endsection


@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="text-center">Enrollments <span class="badge badge-secondary">{{$enrollments->count()}}</span></h4>
    </div>

    <div class="card-body">
        @include('student.enrollment.widgets.table')
    </div>
</div>
  
@endsection