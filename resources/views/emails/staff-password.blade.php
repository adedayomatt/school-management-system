@extends('layouts.mail')

@section('mail-body')
    <p>
    Hello {{$staff->gender == 'male' ? 'Mr.' : ($staff->gender == 'female' ? 'Ms.' : '')}} {{$staff->fullname()}},
    Here is your login details to the school portal at {{url('/')}}</p>
    <p>Email: {{$staff->email}}</p>
    <p>Password: {{$password}}</p>
    <p>Note that you can change your password at any time</p>
@endsection