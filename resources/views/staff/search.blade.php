@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('staff.index')}}">Staff</a></li>
    <li class="breadcrumb-item">Search</li>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @include('staff.widgets.search')
    </div>
</div>
@if(isset($staffs))
    <div class="card">
        <div class="card-header">
            <h4 >Search result for <i><q>{{$keyword}}</q></i> - <span class="badge badge-secondary">{{$staffs->count()}}</span></h4>
        </div>
        <div class="card-body">
            @include('staff.widgets.table')
        </div>
    </div>
@endif
	

@endsection
