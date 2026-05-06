<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('products', 'public');
            $validated['image'] = $path;

            \App\Models\Item::create([
                'title'     => $validated['name'],
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'file_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        $validated['user_id'] = Auth::id();
        Product::create($validated);

        return redirect('/catalog')->with('success', 'Product added!');
    }

    public function edit(Product $product)
    {
        if (Auth::user()->hasRole('seller') && $product->user_id !== Auth::id()) {
            abort(403);
        }
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if (Auth::user()->hasRole('seller') && $product->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'integer|min:0',
        ]);

        $product->update($validated);
        return redirect('/catalog')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        if (Auth::user()->hasRole('seller') && $product->user_id !== Auth::id()) {
            abort(403);
        }
        $product->delete();
        return redirect('/catalog')->with('success', 'Product deleted!');
    }

}
