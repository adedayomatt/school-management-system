@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('staff.index')}}">Staff</a></li>
    <li class="breadcrumb-item active">{{$staff->fullname()}}</li>
@endsection
@section('content')
@if(Auth::user()->isAdmin())
<div class="fixed-operations-pane">
        <div class="m-2">
            <a href="{{ route('staff.edit', [$staff->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> Edit info</a>
        </div>

       <div class="m-2">
            <button data-toggle="collapse" data-target="#choose-role" class="btn btn-primary btn-sm"> <i class="fa fa-user-tag"></i> change role</button>
            <div id="choose-role" class="form-group collapse mt-3"  data-parent=".fixed-operations-pane">
                @include('staff.widgets.change-role')
            </div>
        </div>

        <div class="m-2">
            <button data-toggle="collapse" data-target="#choose-class" class="btn btn-primary btn-sm"><i class="fa fa-chair"></i> {{$staff->classroom_id === null ? 'Assign' : 'Change'}} class</button>
            <div id="choose-class" class="form-group collapse mt-3"  data-parent=".fixed-operations-pane">
                @include('staff.widgets.assign-class')
            </div>
        </div>
        @if($staff->isAuth() && Auth::user()->profile->id != $staff->id)
            <form action="{{ route('staff.reauthorize', [$staff->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary btn-sm m-2"><i class="fa fa-user-shield"></i> re Authorize</button>
            </form>
        @endif
        <div class="m-2">

        @if($staff->isAuth()  && Auth::user()->profile->id != $staff->id)
            @if($staff->user->hasAccess())
                <form action="{{ route('staff.access.revoke', [$staff->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-user-times"></i> Revoke access</button>
                </form>
            @else
                <form action="{{ route('staff.access.restore', [$staff->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-user-check"></i> Restore access</button>
                </form>
            @endif
        @else
                <form action="{{ route('staff.authorize', [$staff->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-user-shield"></i> Authorize</button>
                </form>
        @endif
       </div>
</div>
@endif

    <div class="card">
        <div class="card-header">
            <h4><i class="fa fa-user-tie"></i> {{$staff->fullname()}}</h4>
            <span class="mx-5"><i class="fa fa-user-tie"></i> Role: {!!$staff->role_()!!}</span>
            <span class="mx-5"> <i class="fa fa-chair"></i> Class: {!!$staff->class()!!}</span>
            @if($staff->isAuth() && !$staff->user->hasAccess())
                <div class="alert alert-warning">
                   <i class="fa fa-exclamation-triangle"></i> Access is currently revoked
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="my-2">
                <span class="mx-5"><i class="fa fa-phone"></i> Phone: {{$staff->phone}}</span>
                <span class="mx-5"><i class="fa fa-envelope"></i> Email: {{$staff->email}}</span>
            </div>
        <ul class="list-group">
            <li class="list-group-item">Gender: <strong>{{$staff->gender}}</strong></li>
            <li class="list-group-item">Date of birth: <strong>{{$staff->dob()}}</strong></li>
            <li class="list-group-item">Nationality: <strong>{{$staff->nationality}}</strong></li>
            <li class="list-group-item">State: <strong>{{$staff->state}}</strong></li>
            <li class="list-group-item">LGA: <strong>{{$staff->lga}}</strong></li>
            <li class="list-group-item">Town: <strong>{{$staff->town}}</strong></li>
            <li class="list-group-item">Home Address: <strong>{{$staff->residential_address}}</strong></li>
        </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Emergency</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">Emergency Contact: <strong>{{$staff->emergency_contact}}</strong></li>
            </ul>
        </div>
    </div>

    
            <div class="card">
                <div class="card-header">
                    <h4>Guarantor</h4>
                </div>
                <div class="card-body">
                @if($staff->guarantor !== null)
                    <ul class="list-group">
                        <li class="list-group-item"> Name: <strong>{{$staff->guarantor->fullname()}}</strong></li>
                        <li class="list-group-item"> Phone: <strong>{{$staff->guarantor->phone}}</strong></li>
                        <li class="list-group-item"> Email: <strong>{{$staff->guarantor->email}}</strong></li>
                    </ul>
                    
                    <div class="text-right">
                    <a href="{{route('guarantor.edit',[$staff->id,$staff->guarantor->id])}}">Update Guarantor</a>
                    </div>
                    @else
                        <div class="text-center text-danger">
                            No guarantor <br> <a href="{{route('guarantor.create',[$staff->id])}}" class="btn btn-primary">Add  Guarantor</a>
                        </div>
                    @endif
                </div>
            </div>


@endsection
