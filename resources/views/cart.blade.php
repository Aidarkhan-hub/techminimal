@extends('layouts.app')
@section('title', __('messages.cart'))
@section('content')

<h2>{{ __('messages.shopping_cart') }}</h2>

@if(session('success'))
<div style="color:green;margin-bottom:15px;">{{ session('success') }}</div>
@endif

@if(empty($cart))
<p class="muted">{{ __('messages.cart_empty') }} <a href="/catalog" style="color:#6c63ff;">{{ __('messages.go_to_catalog') }}</a></p>
@else
@php $total = 0; @endphp
@foreach($cart as $item)
@php $total += $item['price'] * $item['quantity']; @endphp
<div style="display:flex;justify-content:space-between;padding:15px;background:rgba(255,255,255,0.05);border-radius:8px;margin-bottom:10px;">
    <span>{{ $item['name'] }} ({{ $item['quantity'] }}x)</span>
    <span>${{ $item['price'] * $item['quantity'] }}</span>
</div>
@endforeach

<div style="text-align:right;margin-top:15px;font-size:18px;font-weight:bold;">
    {{ __('messages.total') }}: ${{ $total }}
</div>

<div style="text-align:right;margin-top:15px;">
    <a href="/payment" style="padding:10px 24px;background:#6c63ff;color:white;border-radius:6px;text-decoration:none;">{{ __('messages.proceed_to_payment') }}</a>
</div>
@endif
@endsection
