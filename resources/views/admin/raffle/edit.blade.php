@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card panel-default">
                    <div class="card-header">Edit raffle</div>
                    <div class="card-body">
                        {!! Form::open(
                            array(
                                'route' => ['raffle.update', $raffle],
                                'class' => 'form',
                                'novalidate' => 'novalidate',
                            ))
                        !!}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="brand" class="control-label">Brand</label>
                                <input type="text" class="form-control {{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand" value="{{ $raffle->brand }}" required>
                                @if ($errors->has('brand'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title" class="control-label">Title</label>
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $raffle->title }}" required>
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="max_tickets">Max tickets</label>
                                <input type="number" class="form-control {{ $errors->has('max_tickets') ? ' is-invalid' : '' }}" name="max_tickets" value="{{ $raffle->max_tickets }}" required>
                                @if ($errors->has('max_tickets'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('max_tickets') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">Type raffle</label>
                                <select name="type" class="form-control">
                                    <option selected value="{{$raffle->type}}" hidden>{{ucfirst($raffle->type)}}</option>
                                    <option value="main">Main</option>
                                    <option value="special">Special</option>
                                    <option value="normal">Normal</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control">{{ $raffle->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-warning" value="Edit raffle">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection