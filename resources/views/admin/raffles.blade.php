@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card panel-default">
                    <div class="card-header">Raffles list</div>
                    <div class="card-body p-0">
                        @if (session('status'))
                            <div class="alert alert-info">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Name</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Tickets</th>
                                    <th class="text-center">Winner</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($raffles as $raffle)
                                <tr>
                                    <th scope="row" class="text-center">{{$raffle->id}}</th>
                                    <td>{{$raffle->brand.' '.$raffle->title}}</td>
                                    <td class="text-center">{{$raffle->type}}</td>
                                    <td class="text-center">{{$raffle->tickets.'/'.$raffle->max_tickets}}</td>
                                    <td class="text-center">{{$raffle->winner}}</td>
                                    @if($raffle->winner)
                                        <td class="text-center"><a href="{{route('raffle.show_winner', $raffle)}}"><button class="btn btn-secondary">Show winner</button></a></td>
                                    @else
                                        <td class="text-center">@if($raffle->tickets == $raffle->max_tickets)<a
                                                    href="{{route('raffle.raffle_winner', $raffle)}}"><button class="btn btn-secondary">Raffle</button></a>@else<button class="btn btn-secondary" disabled>Raffle</button>@endif</td>
                                    @endif
                                    <td class="text-center"><a href="{{route('raffle.participants', $raffle)}}"><button class="btn btn-success">Participants</button></a></td>
                                    <td class="text-center"><a href="{{route('raffle.edit', $raffle)}}"><button class="btn btn-warning">Edit</button></a></td>
                                    <td class="text-center"><a href="{{route('raffle.delete', $raffle)}}"><button class="btn btn-danger">Delete</button></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection