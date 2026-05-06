@extends('layouts.app')
@section('title', __('messages.login'))
@section('content')

<div style="max-width:400px;margin:60px auto;">
    <div style="text-align:center;margin-bottom:32px;">
        <div style="font-size:36px;margin-bottom:12px;"></div>
        <h2 style="margin-bottom:8px;letter-spacing:-0.02em;">{{ __('messages.login') }}</h2>
        <p style="color:var(--muted);font-size:14px;">Welcome back to TechMinimal</p>
    </div>

    @if(session('error'))
    <div style="background:rgba(255,69,58,0.12);border:1px solid rgba(255,69,58,0.3);color:#ff453a;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
        {{ session('error') }}
    </div>
    @endif

    <div style="background:#1c1c1e;border-radius:20px;padding:28px;border:1px solid rgba(255,255,255,.08);">
        <form method="POST" action="/login">
            @csrf
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:13px;font-weight:500;color:var(--muted);margin-bottom:8px;">Email</label>
                <input type="email" name="email" style="width:100%;padding:11px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.1);color:var(--text);border-radius:10px;font-size:15px;outline:none;transition:border-color .2s;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,.1)'" required>
            </div>
            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:500;color:var(--muted);margin-bottom:8px;">Password</label>
                <input type="password" name="password" style="width:100%;padding:11px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.1);color:var(--text);border-radius:10px;font-size:15px;outline:none;transition:border-color .2s;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,.1)'" required>
            </div>
            <button type="submit" style="width:100%;padding:12px;background:var(--accent);color:white;border:none;border-radius:10px;cursor:pointer;font-size:15px;font-weight:600;transition:background .2s;" onmouseover="this.style.background='#0077ed'" onmouseout="this.style.background='var(--accent)'">
                {{ __('messages.login') }}
            </button>
        </form>

        <div style="margin-top:20px;text-align:center;border-top:1px solid rgba(255,255,255,.06);padding-top:20px;">
            <span style="color:var(--muted);font-size:14px;">Don't have an account? </span>
            <a href="/register" style="color:var(--accent);font-size:14px;font-weight:500;text-decoration:none;">{{ __('messages.register') }}</a>
        </div>
    </div>
</div>
@endsection
