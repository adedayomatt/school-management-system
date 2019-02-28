<?php $enrollment = $student->enrollment ?>
@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('student.index')}}">Students</a></li>
    <li class="breadcrumb-item active">{{$enrollment->fullname()}}</li>
@endsection
@section('content')
    <div class="fixed-operations-pane">
        <a href="{{route('enrollment.show',[$enrollment->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> view student file</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                   <img src="{{$enrollment->passport()}}" alt="{{$enrollment->fullname()}}'s passport'" class="passport">
                </div>
                <div class="col-md-6">
                    <h1 style="text-transform: uppercase">{{$enrollment->surname}},</h1>
                    <h3>{{$enrollment->other_names}}</h3>
                        <div>
                            class: <strong><a href="{{route('class.show',[$student->classroom->id])}}">{{$student->classroom->name}}</a></strong>
                        </div>
                </div>
                <div class="col-md-3">
                
                </div>
            </div>
           
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Results</h4>
        </div>
        <div class="card-body">
            <?php $results = $student->allResults()?>
            @include('result.table')
        </div>
    </div>
    
    @if(Auth::user()->isAdmin())
            <h4><i class="fa fa-money"></i> Account</h4>
            <p>Add new fee for {{$student->fullname()}} <button class="btn btn-primary btn-sm mx-2" data-toggle="collapse" data-target="#add-fee"><i class="fa fa-plus"></i> Add fee </button></p>
            <div id="add-fee" class="collapse">
                <form action="{{route('student.fee.add',[$student->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="">Select fee</label>
                    <div class="d-flex">
                        <div class="form-group">
                            <select name="fee" class="form-control select2" style="width: 300px">
                                @foreach($_fees::all() as $f)
                                    @if(!$f->isForGeneral() && !$f->isForClasses() && !$f->payableByStudent($student->id))
                                        <option value="{{$f->id}}">{{$f->name}} ({{$f->ammount}})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-sm mx-3" value="Add Fee">
                        </div>
                    </div>
                    
                </form>
            </div>
        
            @include('student.widgets.account')
        @endif
@endsection
