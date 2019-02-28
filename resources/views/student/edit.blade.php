@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('student.index')}}">Students</a></li>
    <li class="breadcrumb-item"><a href="{{route('student.show',[$student->id])}}">{{$student->application->fullname()}}</a></li>
    <li class="breadcrumb-item active" >Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Update student info</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('application.update',[$student->application->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="surname">Surname <span class="asterik">*</span></label>
                                    <input type="text" name="surname" id="surname" class="form-control" value="{{$student->application->surname}}" required>
                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="other_names">Other names <span class="asterik">*</span></label>
                                    <input type="text" name="other_names" id="other_names" class="form-control" value="{{$student->application->other_names}}" required>
                                    @if ($errors->has('other_names'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('other_names') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth">Date of birth <span class="asterik">*</span></label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{$student->application->date_of_birth}}" required>
                            @if ($errors->has('date_of_birth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                        <label for="gender">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{$student->application->gender === 'male' || $student->application->gender == null ? 'checked' : ''}}>
                                <label class="form-check-label" for="male"> Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{$student->application->gender === 'female' ? 'checked' : ''}}>
                                <label class="form-check-label" for="female"> Female</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" value="{{$student->application->nationality}}">
                            @if ($errors->has('nationality'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{$student->application->state}}">
                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div> @if ($errors->has('lga'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lga') }}</strong>
                                </span>
                            @endif

                        <div class="form-group">
                            <label for="lga">LGA</label>
                            <input type="text" name="lga" id="lga" class="form-control" value="{{$student->application->lga}}">
                           
                        </div>

                        <div class="form-group">
                            <label for="town">Town</label>
                            <input type="text" name="town" id="town" class="form-control"value="{{$student->application->town}}" >
                            @if ($errors->has('town'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('town') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="village">Village</label>
                            <input type="text" name="village" id="village" class="form-control" value="{{$student->application->village}}">
                            @if ($errors->has('village'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('village') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="home_address">Home address</label>
                            <input type="text" name="home_address" id="home_address" class="form-control" value="{{$student->application->home_address}}">
                            @if ($errors->has('home_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="emergency_contact">Emergency Contact</label>
                            <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{$student->application->emergency_contact}}">
                            @if ($errors->has('emergency_contact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('emergency_contact') }}</strong>
                                </span>
                            @endif
                        </div>
                    
                        <div class="form-group">
                            <label for="emergency_phone">Emergency Phone</label>
                            <input type="text" name="emergency_phone" id="emergency_phone" class="form-control" value="{{$student->application->emergency_phone}}">
                            @if ($errors->has('emergency_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('emergency_phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="ailment">Ailment</label>
                            <input type="text" name="ailment" id="ailment" class="form-control" value="{{$student->application->ailment}}">
                            @if ($errors->has('ailment'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ailment') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="siblings">Siblings</label>
                            <input type="text" name="siblings" id="siblings" class="form-control" value="{{$student->application->siblings}}">
                            @if ($errors->has('siblings'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('siblings') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update student">
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

@endsection

