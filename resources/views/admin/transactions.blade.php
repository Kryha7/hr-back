@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card panel-default">
                    <div class="card-header">Transactions</div>
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
                                <th class="text-center">Payment ID</th>
                                <th class="text-center">User ID</th>
                                <th class="text-center">Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class="text-center">{{$transaction->id}}</td>
                                    <td class="text-center">{{$transaction->payment_id}}</td>
                                    <td class="text-center">{{$transaction->user_id}}</td>
                                    <td class="text-center">{{$transaction->amount}} tickets</td>
                                    <td><a href="{{route('transaction.show', $transaction)}}"><button class="btn btn-warning">Show</button></a></td>
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