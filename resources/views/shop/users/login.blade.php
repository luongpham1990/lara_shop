@extends('shop.layouts.app')


@section('content')

    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong> {{ session('error') }}  </strong>
                    </div>
                @endif
                @if(session('alert'))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong> {{ session('alert') }}  </strong>
                    </div>
                @endif
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form method="post" action="{{url('/login')}}">
                            {{ csrf_field() }}
                            <div>
                                <input id="login-email" name="lemail" value="{{old('lemail')}}" type="email" placeholder="Email Address"/>
                                @if ($errors->has('lemail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lemail') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div>
                                <input id="login-password" name="lpassword" value="{{old('lpassword')}}" type="password" placeholder="Password"/>
                                @if ($errors->has('lpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
							<span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form method="post" action="{{url('/register')}}">
                            {{ csrf_field() }}
                            {{--@if(count($errors))--}}
                                {{--@foreach ($errors->all() as $error)--}}
                                    {{--<div>{{ $error }}</div>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                            <div>
                                <input id="username" name="rusername" value="{{old('rusername')}}" type="text" placeholder="Tên hiển thị"/>
                                @if ($errors->has('rusername'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rusername') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div>
                                <input id="email" name="remail" value="{{old('remail')}}" type="email" placeholder="Email"/>
                                @if ($errors->has('remail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('remail') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div>
                                <input id="password" name="rpassword" value="{{old('rpassword')}}" type="password" placeholder="Password"/>
                                @if ($errors->has('rpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div>
                                <input id="password-confirm" name="rpassword_confirmation" value="{{old('re-password')}}" type="password" placeholder="Re-Password"/>
                                @if ($errors->has('rpassword_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rpassword_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
    @endsection