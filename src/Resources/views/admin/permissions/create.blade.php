@extends('backend.layouts.master')
    @section('content')
        <div class="border-bottom white-bg dashboard-header">
            <div class="row">
                <div class="col-lg-12">
                    @include('usermodule::includes.error')
                    @include('usermodule::includes.success')
                    <form class="form-horizontal ng-pristine ng-valid" method="POST" action="{{ route('permissions.store')}}">
                        {{ csrf_field() }}
                    
                            <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Display Name</label>

                                <div class="col-md-6">
                                    <input id="display_name" type="text" class="form-control" name="display_name" value="{{ old('display_name') }}" required>

                                    @if ($errors->has('display_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add Permission
                                    </button>
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    @endsection