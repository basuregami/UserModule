@extends('backend.layouts.master')
@section('content')
    <div class="border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-lg-12">
                    @if( isset($users))
                        <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                @endif

            </div>
        </div>
    </div>
@endsection
