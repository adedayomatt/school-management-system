@extends('layouts.dashboard')

@section('content')
    @if(Auth::user()->isAdmin()  || Auth::user()->isSuperAdmin())
        @include('dashboards.admin')
    @elseif(Auth::user()->isTeacher())
        @include('dashboards.teacher')
    @endif
@endsection