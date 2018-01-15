@extends('backend.layouts.master')
@section('content')
    <div class="border-bottom white-bg dashboard-header">
        <div class="row">

                <div class="col-lg-12">
                    <a  href="{{route('users.create')}}" class="btn btn-primary pull-right"  aria-haspopup="true" aria-expanded="false">
                        Add User</a>
                    @if( isset($users))
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">User List</div>
                            {{--<button class="panel-heading pull-right success">Add User</button>--}}

                            <!-- Table -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>

                                            <td>Edit | Delete</td>


                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                @endif


            </div>
        </div>
    </div>
@endsection