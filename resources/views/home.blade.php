@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('raffle'))
                <div class="alert alert-info">
                    {{ session('raffle') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Raffles</div>
                <div class="card-body">
                    @foreach($raffles as $raffle)
                        <ul>
                            <li><img src="{{asset('img/raffles/'.$raffle->id.'/'.$raffle->thumb)}}" width="200px" alt="{{$raffle->brand.' '.$raffle->title}}"></li>
                            <li>{{$raffle->brand.' '.$raffle->title}}</li>
                            <li>{{$raffle->tickets.'/'.$raffle->max_tickets}}</li>
                            <li>
                                {!! Form::open(
                                    array(
                                        'route' => ['raffle.take_in', $raffle],
                                        'class' => 'form',
                                        'novalidate' => 'novalidate',
                                    ))
                                !!}
                                    <input type="number" name="tickets" class="form-control form-control-sm {{ $errors->has('tickets') ? ' is-invalid' : '' }}" value="{{ old('tickets') }}" required>
                                    @if ($errors->has('tickets'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('tickets') }}</strong>
                                        </div>
                                    @endif
                                    <input type="submit" class="btn btn-warning btn-sm" value="Take in">
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">Pools</div>
                <div class="card-body">
                    @foreach($pools as $pool)
                        <ul>
                            <li>{{$pool->first_option}}@if($pool->first_votes != 0) | {{round(($pool->first_votes/($pool->first_votes + $pool->second_votes))*100)}}% |@else  @endif
                                {!! Form::open(
                                    array(
                                        'route' => ['pool.vote', $pool],
                                        'class' => 'form',
                                        'novalidate' => 'novalidate',
                                    ))
                                !!}
                                    <input hidden type="number" value="1" name="vote">
                                    <input type="submit" class="btn btn-warning btn-sm" value="Vote">
                                {!! Form::close() !!}
                            </li>
                            <li>{{$pool->second_option}} @if($pool->second_votes != 0)| {{round(($pool->second_votes/($pool->first_votes + $pool->second_votes))*100)}}% |@else @endif
                                {!! Form::open(
                                    array(
                                        'route' => ['pool.vote', $pool],
                                        'class' => 'form',
                                        'novalidate' => 'novalidate',
                                    ))
                                !!}
                                    <input hidden type="number" value="2" name="vote">
                                    <input type="submit" class="btn btn-warning btn-sm" value="Vote">
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
