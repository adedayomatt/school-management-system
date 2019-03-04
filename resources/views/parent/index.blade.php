@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Parents</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4><i class="fa fa-user-friends"></i> Parents/Guardian <span class="badge badge-secondary">{{$total}}</span></h4>
        </div>
        <div class="card-body">
            @if($parents->count() > 0)
                @if($parents instanceof \Illuminate\Pagination\LengthAwarePaginator )
                {!!$parents->links()!!}
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Student</th>
                            <th>Relation</th>
                            <th>Occupation</th>
                            <th>Business Address</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parents as $parent)
                            <tr>
                                <td>{{$parent->fullname()}}</td>
                                <td>
                                    <a href="{{route('enrollment.show',$parent->enrollment->id)}}">{{$parent->enrollment->fullname()}}</a>
                                    <div class="text-right">
                                        @if($parent->enrollment->isApproved())
                                        <small>class: <a href="{{route('class.show',[$parent->enrollment->student->classroom->slug])}}">{{$parent->enrollment->student->classroom->name}}</a></small>
                                        @else
                                        <small class="text-warning">Enrollment pending</small>
                                        @endif
                                    </div>
                                </td>
                                <td>{{$parent->relation}}</td>
                                <td>{{$parent->occupation}}</td>
                                <td>{{$parent->business_address}}</td>
                                <td>{{$parent->phone}}</td>
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