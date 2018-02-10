@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card panel-default">
                    <div class="card-header">Edit pool</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            {!! Form::open(
                                array(
                                    'route' => ['pool.update', $pool],
                                    'class' => 'form',
                                    'novalidate' => 'novalidate',
                                ))
                            !!}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_option" class="control-label">First option</label>
                                    <input type="text" class="form-control {{ $errors->has('first_option') ? ' is-invalid' : '' }}" name="first_option" value="{{$pool->first_option}}" required>
                                    @if ($errors->has('first_option'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('first_option') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="second_option" class="control-label">Second option</label>
                                    <input type="text" class="form-control {{ $errors->has('second_option') ? ' is-invalid' : '' }}" name="second_option" value="{{$pool->second_option}}" required>
                                    @if ($errors->has('second_option'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('second_option') }}</strong>
                                        </div>
                                    @endif
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