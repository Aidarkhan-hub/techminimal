@extends('layouts.app')
@section('title', 'Register')
@section('content')

<div style="max-width:420px;margin:40px auto;">
    <div style="text-align:center;margin-bottom:28px;">
        <div style="font-size:48px;margin-bottom:12px;"></div>
        <h1 style="font-size:2rem;font-weight:700;letter-spacing:-0.03em;margin-bottom:8px;">Register</h1>
        <p style="color:#888;font-size:14px;">Create your TechMinimal account</p>
    </div>

    <div style="background:#1c1c1e;border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:32px;">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div style="background:rgba(255,59,48,0.1);border:1px solid rgba(255,59,48,0.3);color:#ff3b30;padding:10px 14px;border-radius:10px;margin-bottom:16px;font-size:13px;">{{ $error }}</div>
            @endforeach
        @endif

        <form method="POST" action="/register">
            @csrf

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:500;color:#888;margin-bottom:6px;">Name</label>
                <input type="text" name="name" placeholder="Your name" value="{{ old('name') }}"
                    style="width:100%;padding:12px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.08);color:#f5f5f7;border-radius:10px;font-size:14px;outline:none;"
                    required>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:500;color:#888;margin-bottom:6px;">Email</label>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    style="width:100%;padding:12px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.08);color:#f5f5f7;border-radius:10px;font-size:14px;outline:none;"
                    required>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:500;color:#888;margin-bottom:6px;">Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password" placeholder="Password"
                        style="width:100%;padding:12px 14px;background:#2c2c2e;border:1px solid rgba(255,255,255,.08);color:#f5f5f7;border-radius:10px;font-size:14px;outline:none;"
                        required>
                    <button type="button" onclick="togglePassword()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#888;cursor:pointer;padding:0;font-size:16px;">👁</button>
                </div>
            </div>

            <button type="submit"
                style="width:100%;padding:13px;background:#0071e3;color:white;border:none;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;letter-spacing:-0.01em;">
                Register
            </button>
        </form>

        <div style="text-align:center;margin-top:20px;font-size:14px;color:#888;">
            Already have an account? <a href="/login" style="color:#0071e3;text-decoration:none;font-weight:500;">Login</a>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    let p = document.getElementById("password");
    p.type = p.type === "password" ? "text" : "password";
}
</script>
@endsection
