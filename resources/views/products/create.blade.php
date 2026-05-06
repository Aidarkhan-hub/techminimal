@extends('layouts.app')
@section('title', __('messages.add_product'))
@section('content')

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    input[type=number] { -moz-appearance: textfield; }
</style>

<div style="max-width:520px;margin:0 auto;">

    <div style="margin-bottom:28px;">
        <a href="/catalog" style="color:var(--accent);text-decoration:none;font-size:14px;font-weight:500;">← {{ __('messages.cancel') }}</a>
        <h2 style="margin-top:12px;letter-spacing:-0.02em;">{{ __('messages.add_product') }}</h2>
        <p style="color:var(--muted);font-size:14px;margin-top:4px;">{{ __('messages.fill_details') }}</p>
    </div>

    @if($errors->any())
    <div style="background:rgba(255,69,58,0.10);border:1px solid rgba(255,69,58,0.25);border-radius:12px;padding:14px 16px;margin-bottom:20px;">
        @foreach($errors->all() as $error)
            <div style="color:#ff453a;font-size:13px;padding:2px 0;">• {{ $error }}</div>
        @endforeach
    </div>
    @endif

    <div style="background:#1c1c1e;border-radius:20px;padding:28px;border:1px solid rgba(255,255,255,.08);">
        <form method="POST" action="/products" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:13px;font-weight:500;color:var(--muted);margin-bottom:8px;">{{ __('messages.name') }}</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    style="width:100%;padding:11px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.1);color:var(--text);border-radius:10px;font-size:15px;outline:none;transition:border-color .2s;"
                    onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,.1)'" required>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:13px;font-weight:500;color:var(--muted);margin-bottom:8px;">{{ __('messages.description') }}</label>
                <textarea name="description" rows="3"
                    style="width:100%;padding:11px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.1);color:var(--text);border-radius:10px;font-size:15px;outline:none;resize:vertical;transition:border-color .2s;font-family:inherit;"
                    onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,.1)'">{{ old('description') }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                <div>
                    <label style="display:block;font-size:13px;font-weight:500;color:var(--muted);margin-bottom:8px;">{{ __('messages.price') }} ($)</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price') }}"
                        style="width:100%;padding:11px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.1);color:var(--text);border-radius:10px;font-size:15px;outline:none;transition:border-color .2s;"
                        onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,.1)'" required>
                </div>
                <div>
                    <label style="display:block;font-size:13px;font-weight:500;color:var(--muted);margin-bottom:8px;">{{ __('messages.stock') }}</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}"
                        style="width:100%;padding:11px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.1);color:var(--text);border-radius:10px;font-size:15px;outline:none;transition:border-color .2s;"
                        onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,.1)'">
                </div>
            </div>

            <div style="margin-bottom:28px;">
                <label style="display:block;font-size:13px;font-weight:500;color:var(--muted);margin-bottom:8px;">{{ __('messages.product_image') }}</label>
                <label style="display:flex;align-items:center;gap:12px;padding:14px;background:#2c2c2e;border:1px dashed rgba(255,255,255,.15);border-radius:10px;cursor:pointer;transition:border-color .2s;" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='rgba(255,255,255,.15)'">
                    <span style="font-size:24px;">📎</span>
                    <div>
                        <div id="fileName" style="font-size:14px;color:var(--text);">{{ __('messages.choose_file') }}</div>
                        <div style="font-size:12px;color:var(--muted);margin-top:2px;">PNG, JPG, WEBP up to 5MB</div>
                    </div>
                    <input type="file" name="image" accept="image/*" style="display:none;" onchange="document.getElementById('fileName').textContent = this.files[0]?.name || '{{ __('messages.choose_file') }}'">
                </label>
            </div>

            <div style="display:flex;gap:12px;align-items:center;">
                <button type="submit"
                    style="flex:1;padding:12px;background:var(--accent);color:white;border:none;border-radius:10px;cursor:pointer;font-size:15px;font-weight:600;transition:background .2s;"
                    onmouseover="this.style.background='#0077ed'" onmouseout="this.style.background='var(--accent)'">
                    {{ __('messages.save') }}
                </button>
                <a href="/catalog"
                    style="padding:12px 20px;background:rgba(255,255,255,.06);color:var(--muted);border-radius:10px;text-decoration:none;font-size:15px;font-weight:500;border:1px solid rgba(255,255,255,.08);">
                    {{ __('messages.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
