@extends('layouts.app')
@section('title', __('messages.users'))
@section('content')

<h2 style="margin-bottom:20px;">{{ __('messages.users') }}</h2>

@if(session('success'))
<div style="background:#1a3a2a;border:1px solid #2d6a4f;color:#52b788;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
    {{ session('success') }}
</div>
@endif

<table style="width:100%;border-collapse:collapse;margin-top:20px;">
    <thead>
    <tr style="border-bottom:1px solid #444;">
        <th style="padding:10px;text-align:left;">{{ __('messages.name') }}</th>
        <th style="padding:10px;text-align:left;">Email</th>
        <th style="padding:10px;text-align:left;">Role</th>
        <th style="padding:10px;text-align:left;">{{ __('messages.edit') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr style="border-bottom:1px solid #333;">
        <td style="padding:10px;">{{ $user->name }}</td>
        <td style="padding:10px;">{{ $user->email }}</td>
        <td style="padding:10px;">
            @foreach($user->roles as $role)
            <span style="background:#6c63ff;padding:2px 8px;border-radius:4px;font-size:12px;">{{ $role->name }}</span>
            @endforeach
        </td>
        <td style="padding:10px;">
            @if(auth()->user()->hasRole('manager|admin') && auth()->id() !== $user->id)
            <form method="POST" action="/users/{{ $user->id }}/role" style="display:flex;gap:8px;align-items:center;">
                @csrf
                <select name="role" style="background:#1e1e2e;border:1px solid #444;color:white;padding:4px 8px;border-radius:6px;">
                    <option value="customer"  {{ $user->hasRole('customer')  ? 'selected' : '' }}>customer</option>
                    <option value="seller"    {{ $user->hasRole('seller')    ? 'selected' : '' }}>seller</option>
                    <option value="manager"   {{ $user->hasRole('manager')   ? 'selected' : '' }}>manager</option>
                    <option value="admin"     {{ $user->hasRole('admin')     ? 'selected' : '' }}>admin</option>
                </select>
                <button type="submit" style="background:#6c63ff;color:white;border:none;border-radius:6px;padding:4px 12px;cursor:pointer;">
                    {{ __('messages.save') }}
                </button>
            </form>
            @else
            <span style="color:#555;font-size:13px;">—</span>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
