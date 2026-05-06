@extends('layouts.app')
@section('title', __('messages.payment'))
@section('content')

@if(session('success'))
<div style="color:green;margin-bottom:15px;">{{ session('success') }}</div>
@endif

<div class="card" style="max-width:500px;margin:auto;">
    <h2 style="margin-bottom:20px;">{{ __('messages.payment') }}</h2>

    <form method="POST" action="/payment">
        @csrf
        <label style="display:block;margin-bottom:5px;">Card Number</label>
        <input type="text" name="card_number" placeholder="0000 0000 0000 0000" style="width:100%;padding:10px;background:#222;border:1px solid #444;color:white;border-radius:8px;margin-bottom:15px;" required>

        <div style="display:flex;gap:10px;margin-bottom:15px;">
            <div style="flex:1;">
                <label style="display:block;margin-bottom:5px;">Expiry</label>
                <input type="text" placeholder="MM/YY" style="width:100%;padding:10px;background:#222;border:1px solid #444;color:white;border-radius:8px;" required>
            </div>
            <div style="flex:1;">
                <label style="display:block;margin-bottom:5px;">CVV</label>
                <input type="text" placeholder="123" style="width:100%;padding:10px;background:#222;border:1px solid #444;color:white;border-radius:8px;" required>
            </div>
        </div>

        <button type="submit" style="width:100%;padding:12px;background:#6c63ff;color:white;border:none;border-radius:8px;cursor:pointer;font-size:16px;">{{ __('messages.pay_now') }}</button>
    </form>
</div>
@endsection
