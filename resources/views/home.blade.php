@extends('layouts.app')
@section('title', __('messages.home'))
@section('content')

<!-- Slider Banner -->
<div style="position:relative;border-radius:20px;overflow:hidden;margin-bottom:32px;height:320px;">
    <div id="slider" style="display:flex;transition:transform 0.5s ease;height:100%;">
        <div style="min-width:100%;height:320px;background:linear-gradient(135deg,#0071e3,#003d82);display:flex;align-items:center;padding:40px 60px;position:relative;overflow:hidden;">
            <div style="z-index:2;">
                <div style="background:rgba(255,255,255,0.2);color:white;font-size:11px;font-weight:600;padding:4px 12px;border-radius:999px;margin-bottom:16px;display:inline-block;letter-spacing:1px;">{{ __('messages.slide1_tag') }}</div>
                <h2 style="font-size:2.2rem;font-weight:700;color:white;margin-bottom:10px;">{{ __('messages.slide1_title') }}</h2>
                <p style="color:rgba(255,255,255,0.75);font-size:15px;margin-bottom:24px;">{{ __('messages.slide1_desc') }}</p>
                <a href="/catalog" style="display:inline-block;padding:10px 24px;background:white;color:#0071e3;border-radius:10px;text-decoration:none;font-size:14px;font-weight:600;">{{ __('messages.shop_now') }} →</a>
            </div>
            <div style="font-size:140px;opacity:0.15;position:absolute;right:40px;"></div>
        </div>
        <div style="min-width:100%;height:320px;background:linear-gradient(135deg,#1c1c1e,#3a3a3c);display:flex;align-items:center;padding:40px 60px;position:relative;overflow:hidden;">
            <div style="z-index:2;">
                <div style="background:rgba(255,255,255,0.15);color:white;font-size:11px;font-weight:600;padding:4px 12px;border-radius:999px;margin-bottom:16px;display:inline-block;letter-spacing:1px;">{{ __('messages.slide2_tag') }}</div>
                <h2 style="font-size:2.2rem;font-weight:700;color:white;margin-bottom:10px;">{{ __('messages.slide2_title') }}</h2>
                <p style="color:rgba(255,255,255,0.75);font-size:15px;margin-bottom:24px;">{{ __('messages.slide2_desc') }}</p>
                <a href="/catalog" style="display:inline-block;padding:10px 24px;background:#0071e3;color:white;border-radius:10px;text-decoration:none;font-size:14px;font-weight:600;">{{ __('messages.view_details') }} →</a>
            </div>
            <div style="font-size:140px;opacity:0.15;position:absolute;right:40px;"></div>
        </div>
        <div style="min-width:100%;height:320px;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;padding:40px 60px;position:relative;overflow:hidden;">
            <div style="z-index:2;">
                <div style="background:rgba(0,113,227,0.3);color:#0071e3;font-size:11px;font-weight:600;padding:4px 12px;border-radius:999px;margin-bottom:16px;display:inline-block;letter-spacing:1px;">{{ __('messages.slide3_tag') }}</div>
                <h2 style="font-size:2.2rem;font-weight:700;color:white;margin-bottom:10px;">{{ __('messages.slide3_title') }}</h2>
                <p style="color:rgba(255,255,255,0.75);font-size:15px;margin-bottom:24px;">{{ __('messages.slide3_desc') }}</p>
                <a href="/catalog" style="display:inline-block;padding:10px 24px;background:#0071e3;color:white;border-radius:10px;text-decoration:none;font-size:14px;font-weight:600;">{{ __('messages.buy_now') }} →</a>
            </div>
            <div style="font-size:140px;opacity:0.15;position:absolute;right:40px;"></div>
        </div>
    </div>
    <button onclick="changeSlide(-1)" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.15);border:none;color:white;width:40px;height:40px;border-radius:50%;cursor:pointer;font-size:18px;">‹</button>
    <button onclick="changeSlide(1)" style="position:absolute;right:16px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.15);border:none;color:white;width:40px;height:40px;border-radius:50%;cursor:pointer;font-size:18px;">›</button>
    <div style="position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:8px;">
        <div class="dot" onclick="goToSlide(0)" style="width:8px;height:8px;border-radius:50%;background:white;cursor:pointer;opacity:1;"></div>
        <div class="dot" onclick="goToSlide(1)" style="width:8px;height:8px;border-radius:50%;background:white;cursor:pointer;opacity:0.4;"></div>
        <div class="dot" onclick="goToSlide(2)" style="width:8px;height:8px;border-radius:50%;background:white;cursor:pointer;opacity:0.4;"></div>
    </div>
</div>

<!-- Why TechMinimal -->
<section style="margin-bottom:32px;">
    <h3 style="margin-bottom:20px;font-size:1.1rem;font-weight:600;">{{ __('messages.why_us') }}</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;">
        <div style="background:#1c1c1e;border-radius:16px;padding:24px;border:1px solid rgba(255,255,255,.08);text-align:center;">
            <div style="font-size:36px;margin-bottom:12px;"></div>
            <div style="font-weight:600;font-size:15px;margin-bottom:6px;">{{ __('messages.best_price') }}</div>
            <div style="color:#888;font-size:13px;line-height:1.6;">{{ __('messages.best_price_desc') }}</div>
        </div>
        <div style="background:#1c1c1e;border-radius:16px;padding:24px;border:1px solid rgba(255,255,255,.08);text-align:center;">
            <div style="font-size:36px;margin-bottom:12px;"></div>
            <div style="font-weight:600;font-size:15px;margin-bottom:6px;">{{ __('messages.minimal') }}</div>
            <div style="color:#888;font-size:13px;line-height:1.6;">{{ __('messages.minimal_desc') }}</div>
        </div>
        <div style="background:#1c1c1e;border-radius:16px;padding:24px;border:1px solid rgba(255,255,255,.08);text-align:center;">
            <div style="font-size:36px;margin-bottom:12px;"></div>
            <div style="font-weight:600;font-size:15px;margin-bottom:6px;">{{ __('messages.original') }}</div>
            <div style="color:#888;font-size:13px;line-height:1.6;">{{ __('messages.original_desc') }}</div>
        </div>
        <div style="background:#1c1c1e;border-radius:16px;padding:24px;border:1px solid rgba(255,255,255,.08);text-align:center;">
            <div style="font-size:36px;margin-bottom:12px;"></div>
            <div style="font-weight:600;font-size:15px;margin-bottom:6px;">{{ __('messages.support') }}</div>
            <div style="color:#888;font-size:13px;line-height:1.6;">{{ __('messages.support_desc') }}</div>
        </div>
    </div>
</section>

<!-- Popular Products -->
<section>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
        <h3 style="margin:0;font-size:1.1rem;font-weight:600;">{{ __('messages.popular_products') }}</h3>
        <a href="/catalog" style="color:#0071e3;text-decoration:none;font-size:14px;font-weight:500;">{{ __('messages.view_all') }} →</a>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
        @forelse($products as $product)
        <div style="background:#1c1c1e;border-radius:16px;border:1px solid rgba(255,255,255,.08);overflow:hidden;transition:transform .2s,box-shadow .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.5)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
            @if($product->image)
            <div style="background:#2c2c2e;height:140px;overflow:hidden;">
                <img src="{{ asset('storage/' . $product->image) }}" style="width:100%;height:140px;object-fit:cover;">
            </div>
            @else
            <div style="height:140px;background:#2c2c2e;display:flex;align-items:center;justify-content:center;color:#3a3a3c;font-size:36px;">📦</div>
            @endif
            <div style="padding:14px;">
                <div style="font-weight:600;font-size:14px;margin-bottom:6px;color:#f5f5f7;">{{ $product->name }}</div>
                <div style="font-size:20px;font-weight:700;color:#f5f5f7;margin-bottom:10px;">${{ number_format($product->price, 0) }}</div>
                <a href="/catalog" style="display:block;text-align:center;padding:8px;background:#0071e3;color:white;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;">{{ __('messages.view_in_catalog') }}</a>
            </div>
        </div>
        @empty
        <p style="color:#888;grid-column:1/-1;">{{ __('messages.no_products') }}</p>
        @endforelse
    </div>
</section>

<script>
let current = 0;
const total = 3;
function changeSlide(dir) { current = (current + dir + total) % total; updateSlider(); }
function goToSlide(index) { current = index; updateSlider(); }
function updateSlider() {
    document.getElementById('slider').style.transform = `translateX(-${current * 100}%)`;
    document.querySelectorAll('.dot').forEach((dot, i) => { dot.style.opacity = i === current ? '1' : '0.4'; });
}
setInterval(() => changeSlide(1), 4000);
</script>
@endsection
