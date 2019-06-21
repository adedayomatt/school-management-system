@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('class.index')}}">Classes</a></li>
<li class="breadcrumb-item active">{{$class->name}}</li>
@endsection
@section('content')
    @include('class.single-class')
    @if(Auth::user()->isAdmin())
        <h5>Fees</h5>
        @if($class->fees->count() > 0)
            @foreach($class->fees as $fee)
                @include('fee.widget',['payments' => $fee->payments()->whereIn('student_id',$class->studentsArray())->get()])
                <div class="text-right">
                    <form action="{{route('class.fee.cancel',[$class->id,$fee->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> cancel {{$fee->name}} fee for {{$class->name}}</button>
                    </form>
                </div>
                <br>
            @endforeach
        @else
            <div class="alert alert-info">No fee for {{$class->name}} to pay</div>
        @endif
    @endif
@endsection
