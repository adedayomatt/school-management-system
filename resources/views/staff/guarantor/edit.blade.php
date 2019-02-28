@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('staff.index')}}">Staff</a></li>
    <li class="breadcrumb-item"><a href="{{route('staff.show',[$guarantor->staff->id])}}">{{$guarantor->staff->fullname()}}</a></li>
    <li class="breadcrumb-item active">Guarantor</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4><a href="{{route('staff.show',[$guarantor->staff->id])}}">{{$guarantor->staff->fullname()}}</a>'s Guarantor</h4>
                </div>
                <div class="card-body">
                        <form action="{{route('guarantor.update',[$guarantor->staff->id, $guarantor->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <p>Fields with <span class="asterik">*</span> are compulsory</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="surname">Surname <span class="asterik">*</span></label>
                                    <input type="text" name="surname" id="surname" class="form-control" value="{{$guarantor->surname}}" required>
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
                                    <input type="text" name="other_names" id="other_names" class="form-control" value="{{$guarantor->other_names}}" required>
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
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{$guarantor->gender === 'male' ||  $guarantor->gender === null ? 'checked' : ''}}>
                                <label class="form-check-label" for="male"> Male</label
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{$guarantor->gender === 'female' ? 'checked' : ''}}>
                                <label class="form-check-label" for="female"> Female</label>
                            </div>
                        </div>


                        <div class="form-group">
                        <label for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status" class="form-control" >
                                <option value="single" {{$guarantor->marital_status === 'single' ? 'selected' : ''}}>Single</option>
                                <option value="married" {{$guarantor->marital_status === 'married' ? 'selected' : ''}}>Married</option>
                                <option value="divorced" {{$guarantor->marital_status === 'divorced' ? 'selected' : ''}}>Divorced</option>
                            </select>
                            @if ($errors->has('marital_status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{$guarantor->phone}}" >
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{$guarantor->email}}" >
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                       
                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" value="{{$guarantor->nationality}}" >
                            @if ($errors->has('nationality'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
                            @endif
                        </div>                        

                        <div class="form-group">
                            <label for="home_address">Home Address</label>
                            <input type="text" name="home_address" id="home_address" class="form-control" value="{{$guarantor->home_address}}" >
                            @if ($errors->has('home_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="business_address">Business Address</label>
                            <input type="text" name="business_address" id="business_address" class="form-control" value="{{$guarantor->business_address}}" >
                            @if ($errors->has('business_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="employer">Employer</label>
                            <input type="tel" name="employer" id="employer" class="form-control" value="{{$guarantor->employer}}" >
                            @if ($errors->has('employer'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('employer') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="years_with_employer">Years with employer</label>
                            <input type="text" name="years_with_employer" id="years_with_employer" class="form-control" value="{{$guarantor->years_with_employer}}" >
                            @if ($errors->has('years_with_employer'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('years_with_employer') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Save Guarantor">
                        </div>
                    </form>

                </div>
            </div>
           
           
        </div>
    </div>

@endsection



