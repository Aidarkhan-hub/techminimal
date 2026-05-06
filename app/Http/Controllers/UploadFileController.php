<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index()
    {
        $items = Item::latest()->get();
        return view('file_upload', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file'  => 'required|file|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $file = $request->file('file');

        $path = $file->store('uploads', 'public');

        Item::create([
            'title'     => $request->title,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return redirect('/upload')->with('success', 'File uploaded successfully!');
    }
}
