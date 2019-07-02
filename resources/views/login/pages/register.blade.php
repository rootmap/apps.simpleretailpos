@extends('login.layout.master')
@section('title','Create your free account')
@section('content')
<section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center">
                    <img src="{{url('images/logo/full-logo.png')}}" alt="Simple Retail Pos logo">
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Create Account</span></h6>
            </div>
            
            <div class="card-body collapse in"> 
                <div class="card-block">
                    <form class="form-horizontal form-simple" action="{{route('register')}}" method="post" novalidate>
                        {{ csrf_field() }}
                        <fieldset class="form-group position-relative has-icon-left mb-1">
                            <input type="text" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control form-control-lg input-lg" placeholder="Name">
                            <div class="form-control-position">
                                <i class="icon-head"></i>
                            </div>
                            @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left mb-1">
                            <input  type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg input-lg" id="user-email" placeholder="Your Email Address" required>
                            <div class="form-control-position">
                                <i class="icon-mail6"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </fieldset>

                        <fieldset class="form-group position-relative has-icon-left" style="margin-bottom:5px;">
                            <input type="password" class="form-control form-control-lg input-lg" id="password" name="password" placeholder="Enter Password" required>
                            <div class="form-control-position">
                                <i class="icon-key3"></i>
                            </div>
                             @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </fieldset>

                        <fieldset class="form-group position-relative has-icon-left">
                            <input class="form-control form-control-lg input-lg"  id="password-confirm" type="password" name="password_confirmation"  placeholder="Confirm Password" required>
                            <div class="form-control-position">
                                <i class="icon-key3"></i>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Register</button>
                    </form>
                </div>
                <p class="text-xs-center">Already have an account ? <a href="{{route('login')}}" class="card-link">Login</a></p>
            </div>
        </div>
    </div>
</section>
@endsection