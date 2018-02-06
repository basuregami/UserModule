@extends('backend.layouts.master')
    @section('content')
        <div class="border-bottom white-bg dashboard-header">
            <div class="row">
                <div class="col-lg-12">
                    @include('usermodule::includes.error')
                    @include('usermodule::includes.success')
                    <form class="form-horizontal ng-pristine ng-valid" method="POST" action="{{ route('users.update')}}">
                        {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{$user->id}}">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$user->name }}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{$user->address }}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">status</label>

                            <div class="col-md-6">
                                <select class="form-control" name="status" id="status">
                                    @if($user->status == 0)
                                        <option value="0" selected>Inactive</option>
                                        <option value="1">Active</option>
                                    @else
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    @endif
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">

                                <label for="role_id" class="col-md-4 control-label">Role</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="role_id" id="role">
                                        @inject('Crypt','Illuminate\Support\Facades\Crypt')
                                            @foreach($roles as $role)   
                                                @foreach ($user->roles as $userRole)
                                                    @if ($role->id  == $userRole->id)
                                                        <option value="{{$role->id}}" selected>{{ $role->display_name }}</option>
                                                    @else    
                                                        <option value="{{$role['id']}}">{{ $role['display_name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                       
                                    </select>
                                    @if ($errors->userValidate->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->userValidate->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                               <div id="contactField"
                            <?php 
                                if ( $errors->has('password') || $errors->has('password-confirm')  )
                                {
                                    echo ' ';
                                }
                                else {
                                    echo ' style="display:none;" ';
                                }  
                            ?> 
                        >

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                </div>
                            </div>


                        </div>

                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-5">
                                    <a id="contactBtn" style="margin-right: 15px;" class="btn btn-success">Update Password</a>
                                </div>
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>

                        </form>

                </div>
            </div>
        </div>
    @endsection
    @section('after-scripts')
        <script type="text/javascript">
            $(document).ready(function () {

                $('#contactBtn').on('click', function (e) {
                    e.preventDefault();
                    $("#contactField").slideToggle();
                });
            })
        </script>
    @endsection
