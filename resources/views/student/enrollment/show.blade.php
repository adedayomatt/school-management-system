@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item "><a href="{{route('enrollment.index')}}">Enrollments</a></li>
<li class="breadcrumb-item active">{{$enrollment->fullname()}}</li>
@endsection
@section('content')
    @if(Auth::user()->isAdmin())
        <div class="fixed-operations-pane">
            <a href="{{route('enrollment.edit',[$enrollment->id])}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-pen"></i> Edit student file</i></a>

            @if($enrollment->parents->count() > 0)
                @foreach($enrollment->parents as $parent)
                    <a href="{{route('parent.edit',[$parent->id])}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-pen"></i> Edit <strong>{{$parent->relation}}</strong> info</i></a>
                @endforeach
            @endif
            <a href="{{route('parent.create',[$enrollment->id])}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-plus"></i> Add new parent</a>
            @if(!$enrollment->isApproved())
                <a href="{{route('student.create',[$enrollment->id])}}" class="btn btn-success btn-sm m-2"> <i class="fa fa-check"></i> Approve enrollment</a>
            @else
                <a href="{{route('student.show',[$enrollment->student->id])}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-user"></i> view student</a>
            @endif 
            <form action="{{route('enrollment.destroy',[$enrollment->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm m-2"><i class="fa fa-trash"></i> Trash file</a>
            </form>
           
        </div>
        @endif
    <h4>Enrollment File</h4>
    <div class="card">
        <div class="card-header">
            <h4>{{$enrollment->fullname()}}</h4>
            {{($enrollment->isApproved() ? 'Sought admission into' : 'Seeking admission into').': '.$enrollment->seeking_admission_into}}
            @if($enrollment->isApproved())
                <div class="d-flex">
                    <div class="mx-3">
                        Admitted Into : {!!$enrollment->admittedInto()!!}
                    </div>
                    <div class="mx-3">
                        Current Class: <a href="{{route('class.show',[$enrollment->student->classroom->slug])}}">{{$enrollment->student->classroom->name}}</a>
                    </div>
                </div>
               
            @endif
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{$enrollment->passport()}}" alt="{{$enrollment->fullname()}}" class="passport">
                </div>
                
            </div>
            <div class="col-md-8">
                @include('student.enrollment.widgets.info')
            </div>
        </div>
        </div>
    </div>

    <h4>Parents</h4>
    @include('student.enrollment.widgets.parent')
    
    <div class="card bg-danger">
        <div class="card-header">
            <h4 class="text-danger"><i class="fa exclamation-triangle"></i> Emergency</h4>
        </div>
        <div class="card-body">
            @include('student.enrollment.widgets.emergency')
        </div>
    </div>

    <div class="my-3">
    @if($enrollment->isApproved())
        <div class="alert alert-success">
            {{$enrollment->fullname()}} is currently in class <a href="{{route('class.show',$enrollment->student->classroom->slug)}}">{{$enrollment->student->classroom->name}}</a>
        </div>
    @endif
    </div>

@endsection
