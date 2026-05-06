@extends('layouts.app')
@section('title', __('messages.catalog'))
@section('content')

@if(session('success'))
<div style="background:rgba(48,209,88,0.12);border:1px solid rgba(48,209,88,0.3);color:#30d158;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
    {{ session('success') }}
</div>
@endif

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;">
    <div>
        <h2 style="margin-bottom:4px;">{{ __('messages.product_catalog') }}</h2>
        <p style="color:var(--muted);font-size:14px;">{{ $products->count() }} products available</p>
    </div>
    @role('seller|admin')
    <a href="/products/create" style="padding:10px 20px;background:var(--accent);color:#000000;border-radius:10px;text-decoration:none;font-size:14px;font-weight:500;transition:background .2s;" onmouseover="this.style.background='#0077ed'" onmouseout="this.style.background='var(--accent)'">+ {{ __('messages.add_product') }}</a>
    @endrole
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px;">
    @forelse($products as $product)
    <div style="background:#1c1c1e;border-radius:16px;border:1px solid rgba(255,255,255,0.08);overflow:hidden;transition:transform .2s,box-shadow .2s;display:flex;flex-direction:column;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 40px rgba(0,0,0,0.6)'" onmouseout="this.style.transform='';this.style.boxShadow=''">

        {{-- Product Image --}}
        <div style="background:#2c2c2e;height:180px;overflow:hidden;display:flex;align-items:center;justify-content:center;">
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" style="width:100%;height:180px;object-fit:cover;transition:transform .3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            @else
            <div style="color:#3a3a3c;font-size:40px;"></div>
            @endif
        </div>

        {{-- Product Info --}}
        <div style="padding:16px;flex:1;display:flex;flex-direction:column;gap:8px;">
            <div style="font-weight:600;font-size:15px;color:#f5f5f7;line-height:1.3;">{{ $product->name }}</div>

            {{-- Price — big and prominent --}}
            <div style="font-size:24px;font-weight:700;color:#f5f5f7;letter-spacing:-0.03em;">${{ number_format($product->price, 2) }}</div>

            <div style="font-size:12px;color:var(--muted);">
                @if($product->stock > 10)
                <span style="color:#2d5c39;">✓ In stock</span>
                @elseif($product->stock > 0)
                <span style="color:#ff9f0a;">⚠ Only {{ $product->stock }} left</span>
                @else
                <span style="color:#ff453a;">✗ Out of stock</span>
                @endif
            </div>

            <div style="margin-top:auto;display:flex;flex-direction:column;gap:8px;">
                {{-- Add to Cart for customers --}}
                <form method="POST" action="/cart/add">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @role('customer')
                    <button type="submit" style="width:100%;padding:10px;background:var(--accent);color:white;border:none;border-radius:10px;cursor:pointer;font-size:14px;font-weight:500;transition:background .2s;" onmouseover="this.style.background='#0077ed'" onmouseout="this.style.background='var(--accent)'">
                         {{ __('messages.add_to_cart') }}
                    </button>
                    @endrole
                </form>

                @role('seller')
                @if($product->user_id === auth()->id())
                <a href="/products/{{ $product->id }}/edit" style="display:block;text-align:center;padding:8px;background:rgba(0,113,227,0.12);color:var(--accent);border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;border:1px solid rgba(0,113,227,0.25);"> {{ __('messages.edit') }}</a>
                <form method="POST" action="/products/{{ $product->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="width:100%;padding:8px;background:rgba(255,69,58,0.12);color:#ff453a;border:1px solid rgba(255,69,58,0.25);border-radius:8px;cursor:pointer;font-size:13px;font-weight:500;"> {{ __('messages.delete') }}</button>
                </form>
                @endif
                @endrole

                @role('manager|admin')
                <a href="/products/{{ $product->id }}/edit" style="display:block;text-align:center;padding:8px;background:rgba(0,113,227,0.12);color:var(--accent);border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;border:1px solid rgba(0,113,227,0.25);"> {{ __('messages.edit') }}</a>
                <form method="POST" action="/products/{{ $product->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="width:100%;padding:8px;background:rgba(255,69,58,0.12);color:#ff453a;border:1px solid rgba(255,69,58,0.25);border-radius:8px;cursor:pointer;font-size:13px;font-weight:500;"> {{ __('messages.delete') }}</button>
                </form>
                @endrole
            </div>
        </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--muted);">
        <div style="font-size:48px;margin-bottom:16px;"></div>
        <p style="font-size:16px;">{{ __('messages.no_products') }}</p>
    </div>
    @endforelse
</div>
@endsection
