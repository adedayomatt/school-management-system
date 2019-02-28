@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('class.index')}}">Classes</a></li>
<li class="breadcrumb-item active">{{$class->name}}</li>
@endsection
@section('content')
    @include('class.single-class')
@endsection
