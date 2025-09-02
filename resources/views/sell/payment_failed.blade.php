@extends('layouts.guest')
@section('title', $title)

@section('content')
<div class="payment-status-container">
    <div class="payment-status-box">
        <div class="image">
            <img src="{{ asset('img/icons/payment-failed.svg') }}" alt="" />
        </div>

        <h2>Payment Failed</h2>

        <span>Sorry, We could not process Your Payment</span>

        <div class="options-btn">
            <button class="secondary-btn">Proceed to Dashboard</button>

            <a href="{{ route('show_invoice', [request()->input('token')]) }}" class="primary-btn">Retry</a>
        </div>
    </div>
</div>
@stop