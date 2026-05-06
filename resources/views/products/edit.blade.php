@extends('layouts.app')
@section('title', __('messages.edit'))
@section('content')
<h2>{{ __('messages.edit') }}</h2>
<form method="POST" action="/products/{{ $product->id }}" enctype="multipart/form-data" style="max-width:500px;">
    @csrf
    @method('PUT')
    <div style="margin-bottom:15px;">
        <label>{{ __('messages.name') }}</label>
        <input type="text" name="name" value="{{ $product->name }}" style="width:100%;padding:8px;margin-top:5px;background:#1e1e2e;border:1px solid #444;color:white;border-radius:6px;" required>
    </div>
    <div style="margin-bottom:15px;">
        <label>{{ __('messages.description') }}</label>
        <textarea name="description" style="width:100%;padding:8px;margin-top:5px;background:#1e1e2e;border:1px solid #444;color:white;border-radius:6px;">{{ $product->description }}</textarea>
    </div>
    <div style="margin-bottom:15px;">
        <label>{{ __('messages.price') }}</label>
        <input type="number" name="price" step="0.01" value="{{ $product->price }}" style="width:100%;padding:8px;margin-top:5px;background:#1e1e2e;border:1px solid #444;color:white;border-radius:6px;" required>
    </div>
    <div style="margin-bottom:15px;">
        <label>{{ __('messages.stock') }}</label>
        <input type="number" name="stock" value="{{ $product->stock }}" style="width:100%;padding:8px;margin-top:5px;background:#1e1e2e;border:1px solid #444;color:white;border-radius:6px;">
    </div>
    <button type="submit" style="padding:10px 20px;background:#6c63ff;color:white;border:none;border-radius:6px;cursor:pointer;">{{ __('messages.save') }}</button>
    <a href="/catalog" style="margin-left:10px;color:#aaa;">{{ __('messages.cancel') }}</a>
</form>
@endsection
