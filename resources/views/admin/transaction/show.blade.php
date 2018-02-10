@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card panel-default">
                    <div class="card-header">Transaction {{$payment->id}}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="payment_id">Payment ID</label>
                                <input type="text" name="payment_id" class="form-control" value="{{$payment->id}}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="payer_id">Payer ID</label>
                                <input type="text" name="payer_id" class="form-control" value="{{$payment->payer->payer_info->payer_id}}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="payer_email">Payer email</label>
                                <input type="email" name="payer_email" class="form-control" value="{{$payment->payer->payer_info->email}}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" class="form-control" value="{{$payment->payer->payer_info->first_name}}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" class="form-control" value="{{$payment->payer->payer_info->last_name}}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="item">Item</label>
                                <input type="text" name="item" class="form-control" value="{{$payment->transactions[0]->item_list->items[0]->name}}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="total">Total</label>
                                <input type="text" class="form-control" value="{{$payment->transactions[0]->amount->total}}$" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection