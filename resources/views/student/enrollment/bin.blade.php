@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('enrollment.index')}}">Enrollments</a> </li>
    <li class="breadcrumb-item active">Bin</li>
@endsection


@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="text-center">Enrollments Bin<span class="badge badge-secondary">{{$enrollments->count()}}</span></h4>
    </div>

    <div class="card-body">
        <form action="{{route('enrollment.bin.action')}}" method="POST">
            @csrf
            @method('PUT')
            
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Guardian/Parent</th>
                        <th>Seeking admission into</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-danger">
                @if($enrollments->count() > 0)
                    @foreach($enrollments as $enrollment)
                        <tr>
                            <td><input type="checkbox" name="enrollments[]" value="{{$enrollment->id}}"></td>
                            <td>{{$enrollment->fullname()}}</td>
                            <td>{{$enrollment->dob()}}</td>
                            <td>{{$enrollment->gender}}</td>
                            <td>
                                @if($enrollment->parents->count() > 0)
                                <ul class="list-group">
                                    @foreach($enrollment->parents as $parent)
                                        <li class="list-group-item">{{$parent->fullname()}}({{$parent->relation}})</li>
                                    @endforeach
                                </ul>
                                @else
                                    <small class="text-center text-danger">No parent/guardian found</small>
                                @endif
                            </td>
                            <td>{{$enrollment->seeking_admission_into}}</td>
                            <td>
                                <small>Trashed {{$enrollment->deleted_at()}}</small>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-danger" >No enrollment in the bin</td>
                        </tr>
                    @endif

                </tbody>
            </table>
            <div class="fixed-operations-pane ">
            <div class="d-flex">
                <select name="action" id="" class="form-control">
                    <option value="1">Restore selected items</option>
                    <option value="2">Permanently delete selected items</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm mx-2"> Apply</button>
            </div>
               
            </div>
        </form>
    </div>
</div>
  
@endsection