@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card panel-default">
                    <div class="card-header">Users</div>
                    <div class="card-body p-0">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Facebook ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-center">Tickets</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{$user->id}}</td>
                                    <td>{{$user->facebook_id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-center">{{$user->tickets}}</td>
                                    <td><a href="{{route('user.edit', $user)}}"><button class="btn btn-warning">Edit</button></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--Pagination--}}
                    {{--<div class="card-footer">--}}
                    {{----}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection