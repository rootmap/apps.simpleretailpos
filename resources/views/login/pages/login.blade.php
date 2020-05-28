@extends('login.layout.master')
@section('title','Login')
@section('content')
<section class="col-md-4 offset-md-4 col-xs-8 offset-xs-2 box-shadow-2 p-0">
	<div class="card border-grey border-lighten-3 px-2 py-2 row mb-0">
		<div class="card-header no-border">
			<div class="card-title text-xs-center">
				<img src="{{url('images/logo/full-logo.png')}}" alt="Simple Retail Pos logo">
			</div>
			<h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2">
				<span>
					Login with Simple Retail POS
				</span>
			</h6>
		</div>
		<div class="card-body collapse in">
			<div class="card-block">
				<form class="form-horizontal" method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}
					<fieldset class="form-group position-relative has-icon-left">
						<input type="text" class="form-control input-lg" id="email" placeholder="Please enter your username." tabindex="1" value="{{ old('email') }}"  name="email"  required autofocus data-validation-required-message= "Please enter your username.">
						<div class="form-control-position">
							<i class="icon-head"></i>
						</div>
						@if ($errors->has('email'))
	                        <div class="help-block font-small-3">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </div>
	                    @endif
					</fieldset>
					<fieldset class="form-group position-relative has-icon-left">
						<input id="password" type="password" class="form-control input-lg" name="password" placeholder="Enter Password" tabindex="2" required data-validation-required-message= "Please enter valid passwords.">
						<div class="form-control-position">
							<i class="icon-key3"></i>
						</div>
						@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
					</fieldset>
					<fieldset class="form-group row">
						<div class="col-md-6 col-xs-12 text-xs-center text-md-left">
							<fieldset>
								<input type="checkbox" id="remember-me" class="chk-remember"name="remember" {{ old('remember') ? 'checked' : '' }}>
								<label for="remember-me"> Remember Me</label>
							</fieldset>
						</div>
						<div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a></div>
					</fieldset>
					<button type="submit" class="btn btn-primary btn-block btn-lg"><i class="icon-unlock2"></i> 
						Login
					</button>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection