@extends('layouts.dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Change password</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
				<h4><i class="fa fa-key"></i> Change password</h4>
				</div>
				<div class="card-body">
                    <form method="POST" action="{{ route('user.password.update') }}" >
                    @csrf
                    @method('PUT')

                    <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                        <label for="old_password" class="control-label">Old password</label>
                        <div class="">
                            <input id="old_password" type="password" class="form-control" name="old_password" placeholder="old password" required>

                            @if ($errors->has('old_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">New password</label>
                        <div class="">
                            <input id="password" type="password" class="form-control" name="password" placeholder="new password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="control-label">Confirm Password</label>

                        <div class="">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm new password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            Update password
                        </button>
                    </div>
                    </form>
				</div>
			</div>
			
		</div>
	</div>
@endsection
