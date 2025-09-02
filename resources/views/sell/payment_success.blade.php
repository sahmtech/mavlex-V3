@extends('layouts.guest')
@section('title', $title)

@section('content')
<div class="payment-status-container">
    <div class="payment-status-box">
        <div class="image">
            <img src="{{ asset('img/icons/success-icon.svg') }}" alt="" />
        </div>

        <h2>Your Payment was successful</h2>

        <span>Recurring Payment? <a href="#">Add a reminder</a> </span>

        <div class="options-btn">
            <a href="{{ route('show_invoice', [request()->input('token')]) }}" class="secondary-btn">Close</a>

            <a href="{{ route('show_invoice', [request()->input('token'), 'print_on_load' => true]) }}" class="primary-btn">Print Invoice</a>
        </div>
    </div>
</div>
@stop
