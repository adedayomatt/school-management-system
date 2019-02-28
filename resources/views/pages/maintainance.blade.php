@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-3">
                <img src="{{asset('assets/logo.png')}}" alt="{{config('app.name')}}">
            </div>
            <div class="card">
                <div class="card-header text-center">
                    <h4  class="text-danger"><i class="fa fa-exclamation-triangle"></i> Ooops, can't access the portal now</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{asset('assets/under-maintenance.jpg')}}" alt="Portal under maintainance" height="200px">
                </div>
                <div class="card-footer text-center">
                    <h4>You check back later</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
