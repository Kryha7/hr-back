@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card panel-default">
                    <div class="card-header">Edit user id {{$user->id}}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {!! Form::open(
                            array(
                                'route' => ['user.update', $user],
                                'class' => 'form',
                                'novalidate' => 'novalidate',
                            ))
                        !!}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>&nbsp;</label>
                                <h2>Actually tickets {{$user->tickets}}</h2>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tickets">Tickets</label>
                                <input type="number" name="tickets" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-warning" value="Edit pool">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection