@extends('admin.layouts.auth_layout')
@section('title', 'Login')

@section('content')
    <!-- login area start -->
    <div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('checklogin') }}" method="post">
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in to E-Pro Mraketplace</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            @if(session("msg"))
                            <div class="alert-dismiss">
                                <div class="alert alert-success alert-dismissible fade show">
                                    <span>{{session("msg")}}</span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-times"></span> </button><br/>
                                </div>
                            </div>
                            @endif
                            @if(count($errors)>0)
                            <div class="alert-dismiss">
                                <div class="alert alert-danger alert-dismissible fade show">
                                    @foreach($errors->all()  as $error)
                                        <span>{{$error}}</span><br/>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>
                            </div>
                            @endif
                            {!!csrf_field()!!}
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" id="exampleInputEmail1">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" id="exampleInputPassword1">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" name="remember_me" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('forgotpassword') }}">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                            <!-- <div class="login-other row mt-4">
                                <div class="col-6">
                                    <a class="fb-login" href="#">Log in with <i class="fa fa-facebook"></i></a>
                                </div>
                                <div class="col-6">
                                    <a class="google-login" href="#">Log in with <i class="fa fa-google"></i></a>
                                </div>
                            </div> -->
                        </div>
                        <div class="form-footer text-center mt-5">
                            <!-- <p class="text-muted">Don't have an account? <a href="javascript:">Sign up</a></p> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

@endsection