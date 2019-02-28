@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('enrollment.show',[$enrollment->id])}}">{{$enrollment->fullname()}}</a></li>
    <li class="breadcrumb-item active">Parent</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>{{$enrollment->fullname()}}'s Parent/Guardian information</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('parent.store',[$enrollment->id])}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="fullname">Parent fullname</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" value="{{old('fullname')}}">
                            @if ($errors->has('fullname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="relation">Relation</label>
                            <select name="relation" id="relation" class="form-control">
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="other">Other</option>
                            </select>
                            <br>
                            <input type="text" name="other_relation" id="other-relation" class="form-control" value="{{old('other_relation')}}" placeholder="specify relation" style="display: none">
                            @if ($errors->has('relation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="home_address">Home Address</label>
                            <input type="text" name="home_address" id="home_address" class="form-control" value="{{old('home_address')}}">
                            @if ($errors->has('home_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" name="occupation" id="occupation" class="form-control" value="{{old('occupation')}}">
                            @if ($errors->has('occupation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('occupation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="business_address">Business Address</label>
                            <input type="text" name="business_address" id="business_address" class="form-control" value="{{old('business_address')}}">
                            @if ($errors->has('business_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_address') }}</strong>
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
                            <input type="submit" class="btn btn-primary" value="Attach Parent">
                        </div>
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>

@endsection
@section('script')
    <script>
       $('select#relation').change(function(){
           if($(this).val() == 'other')
           {
               $('#other-relation').show();
           }else{
            $('#other-relation').hide();
           }
       });
    </script>
@endsection

