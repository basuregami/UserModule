@extends('layouts.app')
@section('title', 'Password Reset') 
@section('description', 'This is Admin Panel Password Reset Section') 
@section('style')
    <link href="{{asset('admin_template/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_template/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('admin_template/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('admin_template/css/style.css')}}" rel="stylesheet">
@endsection
@section('body-class', 'gray-bg')
@section('content')
    <div class="passwordBox animated fadeInDown">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content">
                    <h2 class="font-bold">Reset Password</h2>
                    <p>
                        Enter Your Email address and your password resent link will
                        be eamiled to you in your email address.
                     </p>
                     <div class="row">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                         <div class="col-lg-12">
                             <form method="POST" action="{{ route('admin.password.email') }}" class="m-t">
                                 {{ csrf_field() }}

                                 <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                     <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" required>

                                     @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                     @endif
                                 </div>

                                 <button type="submit" class="btn btn-primary block full-width m-b">Send Password Reset Link</button>

                             </form>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <hr/>
            <p class="m-t"> <small>Linda Cruse © Copyright 2014</small> | All rights reserved </p>
    </div>
@endsection
