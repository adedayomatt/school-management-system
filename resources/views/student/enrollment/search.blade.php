@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('enrollment.index')}}">Enrollments</a></li>
    <li class="breadcrumb-item active">Search</li>
@endsection


@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @include('student.enrollment.widgets.search')
    </div>
</div>
@if(isset($enrollments))
    <div class="card">
        <div class="card-header">
            <h4 >Search result for <i><q>{{$keyword}}</q></i> - <span class="badge badge-secondary">{{$enrollments->count()}}</span></h4>
        </div>

        <div class="card-body">
            @include('student.enrollment.widgets.table')
        </div>
    </div>
@endif
  
@endsection