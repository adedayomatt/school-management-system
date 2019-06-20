@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Students</li>
@endsection


@section('content')

    <div class="fixed-operations-pane">
        <a href="{{route('enrollment.create')}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-plus"></i> New Enrollment</a>
        <a href="{{route('student.export')}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-download"></i> Export students records</a>
        <a href="{{route('student.import')}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-upload"></i> Import students records</a>
    </div>
 @include('student.enrollment.widgets.search')
<div class="card">
    <div class="card-body">
        @include('student.widgets.table')   
    </div>
</div>
@endsection