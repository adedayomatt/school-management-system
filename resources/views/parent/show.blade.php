@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item">{{$parent->enrollment->fullname()}}</li>
    <li class="breadcrumb-item">Parent</li>
    <li class="breadcrumb-item active">{{$parent->fullname()}}</li>
@endsection

@section('content')


@endsection

