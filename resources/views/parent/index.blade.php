@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Parents</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4><i class="fa fa-user-friends"></i> Parents/Guardian <span class="badge badge-secondary">{{$parents->count()}}</span></h4>
        </div>
        <div class="card-body">
            @if($parents->count() > 0)
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Student</th>
                        <th>Relation</th>
                        <th>Occupation</th>
                        <th>Business Address</th>
                        <th>Phone</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parents as $parent)
                        <tr>
                            <td>{{$parent->fullname()}}</td>
                            <td><a href="{{route('student.show',$parent->enrollment->id)}}">{{$parent->enrollment->fullname()}}</a></td>
                            <td>{{$parent->relation}}</td>
                            <td>{{$parent->occupation}}</td>
                            <td>{{$parent->business_address}}</td>
                            <td>{{$parent->phone}}</td>
                            <td>{{$parent->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @else
                <div class="alert alert-secondary text-center">
                    No parent found
                </div>
            @endif
        </div>
    </div>
@endsection