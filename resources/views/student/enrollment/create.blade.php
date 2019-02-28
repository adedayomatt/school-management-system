@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('enrollment.index')}}">Enrollments</a> </li>
    <li class="breadcrumb-item active">New Enrollment</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">New student enrollment</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('enrollment.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="surname">Surname <span class="asterik">*</span></label>
                                    <input type="text" name="surname" id="surname" class="form-control" value="{{old('surname')}}" required>
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
                                    <input type="text" name="other_names" id="other_names" class="form-control" value="{{old('other_names')}}" required>
                                    @if ($errors->has('other_names'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('other_names') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth">Date of birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{old('date_of_birth')}}">
                            @if ($errors->has('date_of_birth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                        <label for="gender">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{old('gender') === 'male' || old('gender') == null ? 'checked' : ''}}>
                                <label class="form-check-label" for="male"> Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{old('gender') === 'female' ? 'checked' : ''}}>
                                <label class="form-check-label" for="female"> Female</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="former_school">Former school attended</label>
                            <input type="text" name="former_school" id="former_school" class="form-control" value="{{old('former_school')}}">
                            @if ($errors->has('former_school'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('former_school') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="former_school_class">Class in former school attended</label>
                            <input type="text" name="former_school_class" id="former_school_class" class="form-control" value="{{old('former_school_class')}}">
                            @if ($errors->has('former_school_class'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('former_school_class') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" value="{{old('nationality')}}">
                            @if ($errors->has('nationality'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{old('state')}}">
                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="lga">LGA</label>
                            <input type="text" name="lga" id="lga" class="form-control" value="{{old('lga')}}">
                            @if ($errors->has('lga'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lga') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="town">Town</label>
                            <input type="text" name="town" id="town" class="form-control"value="{{old('town')}}" >
                            @if ($errors->has('town'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('town') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="village">Village</label>
                            <input type="text" name="village" id="village" class="form-control" value="{{old('village')}}">
                            @if ($errors->has('village'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('village') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="home_address">Home address</label>
                            <input type="text" name="home_address" id="home_address" class="form-control" value="{{old('home_address')}}">
                            @if ($errors->has('home_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="emergency_contact">Emergency Contact</label>
                            <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{old('emergency_contact')}}">
                            @if ($errors->has('emergency_contact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('emergency_contact') }}</strong>
                                </span>
                            @endif
                        </div>
                    
                        <div class="form-group">
                            <label for="emergency_phone">Emergency Phone</label>
                            <input type="text" name="emergency_phone" id="emergency_phone" class="form-control" value="{{old('emergency_phone')}}">
                            @if ($errors->has('emergency_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('emergency_phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="ailment">Ailment</label>
                            <input type="text" name="ailment" id="ailment" class="form-control" value="{{old('ailment')}}">
                            @if ($errors->has('ailment'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ailment') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="siblings">Siblings</label>
                            <input type="number" name="siblings" id="siblings" class="form-control" value="{{old('siblings')}}">
                            @if ($errors->has('siblings'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('siblings') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="seeking_admission_into">Seeking admission into</label>
                            <select name="seeking_admission_into" id="seeking_admission_into" class="form-control">
                                <option value="Playgroup" {{old('seeking_admission_into') == 'Playgroup' ? 'selected' : ''}}>Playgroup</option>
                                <option value="Nursery 1" {{old('seeking_admission_into') == 'Nursery 1' ? 'selected' : ''}}>Nursery 1</option>
                                <option value="Nursery 2" {{old('seeking_admission_into') == 'Nursery 2' ? 'selected' : ''}}>Nursery 2</option>
                                <option value="Nursery 3" {{old('seeking_admission_into') == 'Nursery 3' ? 'selected' : ''}}>Nursery 3</option>
                                <option value="Basic 1" {{old('seeking_admission_into') == 'Basic 1' ? 'selected' : ''}}>Basic 1</option>
                                <option value="Basic 2" {{old('seeking_admission_into') == 'Basic 2' ? 'selected' : ''}}>Basic 2</option>
                                <option value="Basic 3" {{old('seeking_admission_into') == 'Basic 3' ? 'selected' : ''}}>Basic 3</option>
                                <option value="Basic 4" {{old('seeking_admission_into') == 'Basic 4' ? 'selected' : ''}}>Basic 4</option>
                                <option value="Basic 5" {{old('seeking_admission_into') == 'Basic 5' ? 'selected' : ''}}>Basic 5</option>
                            </select>
                            @if ($errors->has('seeking_admission_into'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('seeking_admission_into') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Enroll Student">
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

@endsection

