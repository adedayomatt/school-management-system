@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('enrollment.index')}}">Enrollments</a></li>
<li class="breadcrumb-item"><a href="{{route('enrollment.show',[$enrollment->id])}}">{{$enrollment->fullname()}}</a></li>
<li class="breadcrumb-item active">Admission</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">{{$enrollment->fullname()}} Admission</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('student.store',[$enrollment->id])}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="class">Admit <strong>{{$enrollment->fullname()}}</strong> into</label>
                            <select name="class" id="class" class="form-control select2">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{old('class') === $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('class'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Admit student">
                        </div>
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>

@endsection

