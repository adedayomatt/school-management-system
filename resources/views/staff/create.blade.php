@extends('layouts.dashboard')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('staff.index')}}">Staff</a></li>
<li class="breadcrumb-item active">New Staff {{isset($target_role) && $target_role !== null ? '($target_role->name)' : ''}}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>New Staff</h4>
                </div>
                <div class="card-body">
                        @if($roles->count()  > 0)
                        <form action="{{route('staff.store')}}" method="POST">
                        @csrf
                        <p>Fields with <span class="asterik">*</span> are compulsory</p>
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
                        <label for="gender">Gender <span class="asterik">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{old('gender') === 'male' ||  old('gender') === null ? 'checked' : ''}}>
                                <label class="form-check-label" for="male"> Male</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{old('gender') === 'female' ? 'checked' : ''}}>
                                <label class="form-check-label" for="female"> Female</label>
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
                        <label for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status" class="form-control">
                                <option value="single" {{old('marital_status') === 'single' ? 'selected' : ''}}>Single</option>
                                <option value="married" {{old('marital_status') === 'married' ? 'selected' : ''}}>Married</option>
                                <option value="divorced" {{old('marital_status') === 'divorced' ? 'selected' : ''}}>Divorced</option>
                            </select>
                            @if ($errors->has('marital_status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{old('phone')}}">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="first_appointment">Date of first appointment</label>
                            <input type="date" name="first_appointment" id="first_appointment" class="form-control" value="{{old('first_appointment')}}">
                            @if ($errors->has('first_appointment'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_appointment') }}</strong>
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
                            <label for="state_of_origin">State of origin</label>
                            <input type="text" name="state_of_origin" id="state_of_origin" class="form-control" value="{{old('state_of_origin')}}">
                            @if ($errors->has('state_of_origin'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state_of_origin') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="lga">Local Government Area</label>
                            <input type="text" name="lga" id="lga" class="form-control" value="{{old('lga')}}">
                            @if ($errors->has('lga'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lga') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="town">Town</label>
                            <input type="text" name="town" id="town" class="form-control" value="{{old('town')}}">
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
                            <label for="permanent_address">Permanent Address</label>
                            <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="{{old('permanent_address')}}">
                            @if ($errors->has('permanent_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('permanent_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="residential_address">Residential Address</label>
                            <input type="text" name="residential_address" id="residential_address" class="form-control" value="{{old('residential_address')}}">
                            @if ($errors->has('residential_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('residential_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="emergency_contact">Emergency contact</label>
                            <small>Phone number of who to call in case of emergency</small>
                            <input type="tel" name="emergency_contact" id="emergency_contact" class="form-control" value="{{old('emergency_contact')}}">
                            @if ($errors->has('emergency_contact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('emergency_contact') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{(isset($target_role) && $target_role !== null && $role->id === $target_role->id) || (old('role') === $role->id) ? 'selected' : ''}}> {{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="class">Class</label>
                            <select name="class" id="class" class="form-control">
                                <option value="">select class</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{(isset($target_class) && $target_class !== null && $class->id === $target_class->id) || (old('class') === $class->id) ? 'selected' : ''}}> {{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add Staff">
                        </div>
                    </form>
                    @else

                    <div class="text-center">
                        There is no role yet, new staff cannot be added
                        <br>
                        <a href="{{route('role.create')}}" class="btn btn-primary">create role</a>
                    </div>
                    @endif
                </div>
            </div>
           
           
        </div>
    </div>

@endsection



