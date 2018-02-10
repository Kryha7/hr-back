@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card panel-default">
                    <div class="card-header">Raffles ID {{$raffle->id}} participants | <span class="badge badge-info">{{$raffle->tickets.'/'.$raffle->max_tickets}}</span></div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <th scope="row" class="text-center">{{$transaction->id}}</th>
                                        <th class="text-center">{{$transaction->user_id}}</th>
                                        <th class="text-center">{{$transaction->amount}}</th>
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