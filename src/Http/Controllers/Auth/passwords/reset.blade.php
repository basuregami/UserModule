@extends('layouts.app')
@section('title', 'Admin Password Reset') 
@section('description', 'This is Admin Panel Password Reset Page') 
@section('style')
     <link href="{{asset('admin_template/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('admin_template/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('admin_template/css/style.css')}}" rel="stylesheet">
@endsection
@section('body-class', 'gray-bg')
@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <img src="{{ asset('admin_template/img/olive_safety.png') }}" alt="">
        </div>
        <h3>Reset Password</h3>
        <p>Type your email and password. </p>
        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <form class="m-t" role="form" method="POST" action="{{ route('admin.password.request') }}">
            
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" id="email" name="email" class="form-control" value="{{ $email or old('email') }}" placeholder="Type your Email Address" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif 
            </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif          
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif             
            </div>
            
            <button type="submit" class="btn btn-primary block full-width m-b">Reset Password</button>            
        </form>
         <p class="m-t"> <small>Linda Cruse © Copyright 2014</small> | All rights reserved </p>
    </div>
</div>
@endsection
