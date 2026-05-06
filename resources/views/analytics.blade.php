@extends('layouts.app')
@section('title', __('messages.analytics'))
@section('content')

<div style="max-width:900px;margin:0 auto;">
    <h2 style="margin-bottom:6px;">{{ __('messages.my_analytics') }}</h2>
    <p style="color:#888;margin-bottom:28px;">{{ __('messages.your_stats') }}</p>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-bottom:32px;">
        <div style="background:#1c1c1e;border-radius:16px;padding:20px;border:1px solid rgba(255,255,255,.08);">
            <div style="color:#888;font-size:13px;margin-bottom:8px;">{{ __('messages.total_products') }}</div>
            <div style="font-size:32px;font-weight:700;color:#0071e3;">{{ $totalProducts }}</div>
        </div>
        <div style="background:#1c1c1e;border-radius:16px;padding:20px;border:1px solid rgba(255,255,255,.08);">
            <div style="color:#888;font-size:13px;margin-bottom:8px;">{{ __('messages.total_value') }}</div>
            <div style="font-size:32px;font-weight:700;color:#30d158;">${{ number_format($totalValue, 0) }}</div>
        </div>
        <div style="background:#1c1c1e;border-radius:16px;padding:20px;border:1px solid rgba(255,255,255,.08);">
            <div style="color:#888;font-size:13px;margin-bottom:8px;">{{ __('messages.in_stock') }}</div>
            <div style="font-size:32px;font-weight:700;color:#30d158;">{{ $inStock }}</div>
        </div>
        <div style="background:#1c1c1e;border-radius:16px;padding:20px;border:1px solid rgba(255,255,255,.08);">
            <div style="color:#888;font-size:13px;margin-bottom:8px;">{{ __('messages.out_of_stock') }}</div>
            <div style="font-size:32px;font-weight:700;color:#ff3b30;">{{ $outOfStock }}</div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
        <div style="background:#1c1c1e;border-radius:16px;padding:24px;border:1px solid rgba(255,255,255,.08);">
            <h3 style="margin-bottom:16px;font-size:15px;">{{ __('messages.products_by_price') }}</h3>
            <canvas id="barChart"></canvas>
        </div>
        <div style="background:#1c1c1e;border-radius:16px;padding:24px;border:1px solid rgba(255,255,255,.08);">
            <h3 style="margin-bottom:16px;font-size:15px;">{{ __('messages.stock_distribution') }}</h3>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <div style="background:#1c1c1e;border-radius:16px;padding:24px;border:1px solid rgba(255,255,255,.08);">
        <h3 style="margin-bottom:16px;font-size:15px;">{{ __('messages.my_products') }}</h3>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                    <th style="padding:10px;text-align:left;color:#888;font-size:13px;">{{ __('messages.name') }}</th>
                    <th style="padding:10px;text-align:left;color:#888;font-size:13px;">{{ __('messages.price') }}</th>
                    <th style="padding:10px;text-align:left;color:#888;font-size:13px;">{{ __('messages.stock') }}</th>
                    <th style="padding:10px;text-align:left;color:#888;font-size:13px;">{{ __('messages.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);">
                    <td style="padding:10px;font-size:14px;">{{ $product->name }}</td>
                    <td style="padding:10px;font-size:14px;color:#0071e3;">${{ number_format($product->price, 0) }}</td>
                    <td style="padding:10px;font-size:14px;">{{ $product->stock }}</td>
                    <td style="padding:10px;">
                        @if($product->stock > 0)
                            <span style="background:rgba(48,209,88,0.15);color:#30d158;padding:2px 10px;border-radius:999px;font-size:12px;">{{ __('messages.in_stock') }}</span>
                        @else
                            <span style="background:rgba(255,59,48,0.15);color:#ff3b30;padding:2px 10px;border-radius:999px;font-size:12px;">{{ __('messages.out_of_stock') }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="padding:20px;text-align:center;color:#888;">{{ __('messages.no_products') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const products = @json($products);
    const names = products.map(p => p.name);
    const prices = products.map(p => p.price);

    new Chart(document.getElementById("barChart"), {
        type: "bar",
        data: {
            labels: names,
            datasets: [{ label: "{{ __('messages.price') }} ($)", data: prices, backgroundColor: "rgba(0,113,227,0.7)", borderRadius: 8 }]
        },
        options: {
            plugins: { legend: { labels: { color: "#e0e0e0" } } },
            scales: {
                x: { ticks: { color: "#888" }, grid: { color: "rgba(255,255,255,0.05)" } },
                y: { ticks: { color: "#888" }, grid: { color: "rgba(255,255,255,0.05)" } }
            }
        }
    });

    new Chart(document.getElementById("pieChart"), {
        type: "doughnut",
        data: {
            labels: ["{{ __('messages.in_stock') }}", "{{ __('messages.out_of_stock') }}"],
            datasets: [{ data: [{{ $inStock }}, {{ $outOfStock }}], backgroundColor: ["rgba(48,209,88,0.8)", "rgba(255,59,48,0.8)"] }]
        },
        options: { plugins: { legend: { labels: { color: "#e0e0e0" } } } }
    });
</script>
@endsection
