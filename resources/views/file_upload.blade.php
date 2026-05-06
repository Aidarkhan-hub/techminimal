@extends('layouts.app')
@section('title', 'File Upload')
@section('content')

<div style="max-width:600px;margin:0 auto;">
    <h2 style="margin-bottom:20px;">📁 File Upload</h2>

    @if(session('success'))
        <div style="background:#1a3a2a;border:1px solid #2d6a4f;color:#52b788;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#3a1a1a;border:1px solid #6a2d2d;color:#e07070;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="margin-bottom:30px;">
        <form method="POST" action="/upload" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:8px;font-weight:600;">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    style="width:100%;padding:10px;background:#12151f;border:1px solid #2e3347;color:white;border-radius:8px;box-sizing:border-box;" required>
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:600;">Choose File</label>
                <input type="file" name="file"
                    style="width:100%;padding:10px;background:#12151f;border:1px solid #2e3347;color:white;border-radius:8px;box-sizing:border-box;" required>
            </div>
            <button type="submit" style="width:100%;padding:12px;background:#6c63ff;color:white;border:none;border-radius:8px;cursor:pointer;font-size:15px;">
                Upload
            </button>
        </form>
    </div>

    <h3 style="margin-bottom:16px;">Uploaded Files</h3>
    @forelse($items as $item)
    <div class="card" style="margin-bottom:12px;display:flex;justify-content:space-between;align-items:center;">
        <div>
            <div style="font-weight:600;">{{ $item->title }}</div>
            <div class="muted" style="font-size:13px;">{{ $item->file_name }} · {{ number_format($item->file_size / 1024, 1) }} KB · {{ $item->file_type }}</div>
        </div>
        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
            style="padding:6px 14px;background:#2a2a3a;color:#6c63ff;border:1px solid #6c63ff;border-radius:6px;text-decoration:none;font-size:13px;">
            View
        </a>
    </div>
    @empty
        <p class="muted">No files uploaded yet.</p>
    @endforelse
</div>

@endsection
