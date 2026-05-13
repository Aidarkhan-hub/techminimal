<?php
namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
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
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
        $result = $cloudinary->uploadApi()->upload($file->getRealPath(), ['folder' => 'uploads']);
        $url = $result['secure_url'];
        Item::create([
            'title'     => $request->title,
            'file_path' => $url,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);
        return redirect('/upload')->with('success', 'File uploaded successfully!');
    }
}
