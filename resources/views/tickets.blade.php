@extends('layouts.app')

@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Tickets</h1>
    <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
        @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
        @endif
</div>
    <div class="container">
        <div class="card-deck mb-3 text-center">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">5 tickets</h4>
                </div>
                <div class="card-body">
                    <form method="POST" id="payment-form" role="form" action="{{route('paypal')}}">{{ csrf_field() }}
                    <h1 class="card-title pricing-card-title">$9<small class="text-muted">.99</small></h1>
                        <input type="text" hidden name="name" value="5 tickets">
                        <input type="text" hidden name="description" value="5 tickets on hyperaffle.com">
                        <input type="number" hidden name="tickets" value="5">
                        <input type="number" hidden name="amount" value="9.99">
                    <ul class="list-unstyled mt-4 mb-4">
                        <li>10 users included</li>
                        <li>2 GB of storage</li>
                        <li>Email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="submit" class="btn btn-lg btn-block btn-primary">Beginning</button>
                    </form>
                </div>
            </div>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">20 tickets</h4>
                </div>
                <div class="card-body">
                    <form method="POST" id="payment-form" role="form" action="{{route('paypal')}}">{{ csrf_field() }}
                    <h1 class="card-title pricing-card-title">$24<small class="text-muted">.99</small></h1>
                        <input type="text" hidden name="name" value="20 tickets">
                        <input type="text" hidden name="description" value="20 tickets on hyperaffle.com">
                        <input type="number" hidden name="tickets" value="20">
                        <input type="number" hidden name="amount" value="24.99">
                    <ul class="list-unstyled mt-4 mb-4">
                        <li>20 users included</li>
                        <li>10 GB of storage</li>
                        <li>Priority email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Get started</button>
                    </form>
                </div>
            </div>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">100 tickets</h4>
                </div>
                <div class="card-body">
                    <form method="POST" id="payment-form" role="form" action="{{route('paypal')}}">{{ csrf_field() }}
                    <h1 class="card-title pricing-card-title">$49<small class="text-muted">.99</small></h1>
                        <input type="text" hidden name="name" value="50 tickets">
                        <input type="text" hidden name="description" value="50 tickets on hyperaffle.com">
                        <input type="number" hidden name="tickets" value="100">
                        <input type="number" hidden name="amount" value="49.99">
                    <ul class="list-unstyled mt-4 mb-4">
                        <li>30 users included</li>
                        <li>15 GB of storage</li>
                        <li>Phone and email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Subscription</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection