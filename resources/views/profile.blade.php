@extends('layouts.app')
@section('title', __('messages.profile'))
@section('content')
<div style="display:flex;gap:20px;flex-wrap:wrap;">
    <div style="flex:1;min-width:220px;background:#1c1c1e;border-radius:20px;padding:28px;text-align:center;border:1px solid rgba(255,255,255,.08);">
        <div style="width:84px;height:84px;background:var(--accent);border-radius:50%;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;font-size:34px;font-weight:700;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <h3 style="margin-bottom:6px;font-size:1.2rem;letter-spacing:-0.01em;">{{ auth()->user()->name }}</h3>
        <p style="color:var(--muted);font-size:13px;margin-bottom:14px;">{{ auth()->user()->email }}</p>
        <p>
            @foreach(auth()->user()->roles as $role)
            <span style="background:rgba(0,113,227,0.15);color:var(--accent);padding:4px 12px;border-radius:999px;font-size:12px;font-weight:600;border:1px solid rgba(0,113,227,0.3);">{{ $role->name }}</span>
            @endforeach
        </p>
    </div>

    <div style="flex:2;min-width:300px;background:#1c1c1e;border-radius:20px;padding:28px;border:1px solid rgba(255,255,255,.08);">
        <h4 style="margin:0 0 20px;font-size:1rem;font-weight:600;">{{ __('messages.recent_orders') }}</h4>
        @forelse($orders as $order)
        <div style="border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px;margin-bottom:12px;background:rgba(255,255,255,.02);">
            <div style="display:flex;justify-content:space-between;margin-bottom:10px;align-items:center;">
                <span style="font-weight:600;font-size:14px;">Order #{{ $order->id }}</span>
                <span style="background:rgba(48,209,88,0.12);color:#30d158;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:500;border:1px solid rgba(48,209,88,0.25);">{{ $order->status }}</span>
            </div>
            <div style="margin-bottom:10px;">
                @foreach($order->items as $item)
                <div style="color:var(--muted);font-size:13px;padding:3px 0;">• {{ $item['name'] }} × {{ $item['quantity'] }} — ${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                @endforeach
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <span style="color:var(--muted);font-size:12px;">{{ $order->created_at->format('d M Y, H:i') }}</span>
                <span style="font-weight:700;color:var(--accent);font-size:16px;">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:40px 0;color:var(--muted);">
            <div style="font-size:36px;margin-bottom:12px;">🛍</div>
            <p>{{ __('messages.no_orders') }}</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
