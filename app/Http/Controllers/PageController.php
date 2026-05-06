<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        $products = Product::latest()->take(5)->get();
        return view('home', compact('products'));
    }

    public function catalog()
    {
        $products = Product::where('is_active', true)->get();
        return view('catalog', compact('products'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect('/cart')->with('success', 'Added to cart!');
    }

    public function payment()
    {
        return view('payment');
    }

    public function profile()
    {
        $orders = \App\Models\Order::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('profile', compact('orders'));
    }

    public function analytics()
    {
        if (!auth()->user()->hasRole('seller')) {
            abort(403);
        }

        $userId = auth()->id();

        $products = \App\Models\Product::where('user_id', $userId)->get();
        $totalProducts = $products->count();
        $totalValue = $products->sum('price');
        $inStock = $products->where('stock', '>', 0)->count();
        $outOfStock = $products->where('stock', 0)->count();

        return view('analytics', compact('products', 'totalProducts', 'totalValue', 'inStock', 'outOfStock'));
    }

    public function users()
    {
        $users = User::with('roles')->get();
        return view('users', compact('users'));
    }
    public function processPayment(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $customerName = Auth::user()->name;

        // Сохраняем заказ в БД
        \App\Models\Order::create([
            'user_id' => Auth::id(),
            'items'   => $cart,
            'total'   => $total,
            'status'  => 'paid',
        ]);

        // Письмо покупателю
        \Mail::to(Auth::user()->email)->send(
            new \App\Mail\OrderConfirmation($cart, $total, $customerName)
        );

        // Письма продавцам
        $productIds = array_keys($cart);
        $products = \App\Models\Product::with('user')->whereIn('id', $productIds)->get();

        foreach ($products->groupBy('user_id') as $sellerProducts) {
            $seller = $sellerProducts->first()->user;
            if (!$seller) continue;
            $sellerItems = $sellerProducts->map(fn($p) => $cart[$p->id])->toArray();
            $sellerTotal = collect($sellerItems)->sum(fn($i) => $i['price'] * $i['quantity']);
            \Mail::to($seller->email)->send(
                new \App\Mail\NewOrderSeller($sellerItems, $customerName, $sellerTotal)
            );
        }

        session()->forget('cart');
        return redirect('/payment')->with('success', 'Оплата прошла! Подтверждение отправлено на ' . Auth::user()->email);
    }
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:customer,seller,manager,admin'
        ]);

        $user->syncRoles([$request->role]);
        return back()->with('success', $user->name . ' теперь ' . $request->role);
    }
}
