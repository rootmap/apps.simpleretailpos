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
                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Create Accounts</span></h6>
            </div>
            <div class="card-body collapse in"> 
                <div class="card-block">
                    <form class="form-horizontal form-simple" action="#" novalidate>
                        <fieldset class="form-group position-relative has-icon-left mb-1">
                            <input type="text" class="form-control form-control-lg input-lg" id="user-name" name="name" placeholder="User Name">
                            <div class="form-control-position">
                                <i class="icon-head"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left mb-1">
                            <input type="email" class="form-control form-control-lg input-lg" id="user-email" name="email" placeholder="Your Email Address" required>
                            <div class="form-control-position">
                                <i class="icon-mail6"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control form-control-lg input-lg" name="password" id="user-password" placeholder="Enter Password" required>
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