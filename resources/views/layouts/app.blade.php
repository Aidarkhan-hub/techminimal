<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechMinimal — @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:        #000000;
            --bg-card:   #1c1c1e;
            --bg-card2:  #2c2c2e;
            --border:    rgba(255,255,255,0.10);
            --accent:    #0071e3;
            --accent-h:  #0077ed;
            --text:      #f5f5f7;
            --muted:     #86868b;
            --danger:    #ff453a;
            --success:   #30d158;
        }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(ellipse 80vw 60vh at 15% 10%, rgba(0,113,227,0.18) 0%, transparent 70%),
                radial-gradient(ellipse 60vw 50vh at 85% 20%, rgba(94,92,230,0.14) 0%, transparent 65%),
                radial-gradient(ellipse 70vw 55vh at 50% 80%, rgba(0,113,227,0.15) 0%, transparent 70%);
        }
        nav, .main, footer { position: relative; z-index: 1; }
        h1 { font-size: 4vw; font-weight: 700; letter-spacing: -0.02em; }
        h2 { font-size: 3vw; font-weight: 700; letter-spacing: -0.01em; }
        h3 { font-size: 2.5vw; font-weight: 600; }
        img { max-width: 100%; height: auto; }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
            height: 52px;
            background: rgba(0,0,0,0.85);
            backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 200;
        }
        .nav-brand { font-weight: 600; font-size: 18px; color: var(--text); text-decoration: none; }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-links a { color: var(--muted); text-decoration: none; margin-left: 12px; font-size: 13px; font-weight: 400; transition: color .2s; }
        .nav-links a:hover { color: var(--text); }
        .hamburger { display: none; background: none; border: 1px solid var(--border); color: var(--text); padding: 5px 10px; border-radius: 6px; cursor: pointer; font-size: 16px; }

        /* Layout */
        .main { padding: 40px 5%; width: 100%; flex: 1; }

        /* Cards */
        .card { background: var(--bg-card); border-radius: 16px; padding: 16px; width: 100%; border: 1px solid var(--border); }
        .muted { color: var(--muted); font-size: 14px; }

        /* Buttons */
        button, .btn { background: var(--accent); color: white; border: none; border-radius: 8px; padding: 8px 16px; cursor: pointer; font-size: 14px; font-weight: 500; transition: background .2s; text-decoration: none; display: inline-block; }
        button:hover, .btn:hover { background: var(--accent-h); }
        .btn-danger { background: var(--danger); }
        .btn-danger:hover { background: #ff6961; }

        /* Language dropdown */
        .lang-dropdown { position: relative; margin-left: 16px; }
        .lang-dropdown-btn { background: rgba(255,255,255,0.06); color: var(--muted); border: 1px solid var(--border); border-radius: 6px; padding: 5px 10px; cursor: pointer; font-size: 13px; }
        .lang-dropdown-btn:hover { border-color: var(--accent); color: var(--text); }
        .lang-dropdown-menu { display: none; position: absolute; right: 0; top: 120%; background: #1c1c1e; border: 1px solid var(--border); border-radius: 10px; min-width: 140px; z-index: 300; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.6); }
        .lang-dropdown-menu.open { display: block; }
        .lang-dropdown-menu a { display: block; padding: 9px 16px; color: var(--muted); text-decoration: none; font-size: 13px; }
        .lang-dropdown-menu a:hover { background: rgba(0,113,227,0.15); color: var(--text); }
        .lang-dropdown-menu a.active { color: var(--accent); }

        /* Footer */
        footer { background: #111111; border-top: 1px solid var(--border); padding: 40px 5% 24px; margin-top: auto; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 32px; margin-bottom: 32px; }
        .footer-col h4 { color: var(--text); font-size: 13px; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; }
        .footer-col a { display: block; color: var(--muted); text-decoration: none; font-size: 13px; margin-bottom: 8px; }
        .footer-col a:hover { color: var(--text); }
        .footer-bottom { border-top: 1px solid var(--border); padding-top: 20px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; }
        .footer-bottom p { color: var(--muted); font-size: 12px; }

        /* Responsive */
        @media (max-width: 768px) {
            h1 { font-size: 6vw; } h2 { font-size: 5vw; } h3 { font-size: 4vw; }
            .hamburger { display: block; }
            .nav-links { display: none; width: 100%; flex-direction: column; align-items: flex-start; background: rgba(0,0,0,0.95); position: fixed; top: 52px; left: 0; right: 0; border-bottom: 1px solid var(--border); padding: 16px 5%; }
            .nav-links.open { display: flex; }
            .nav-links a { margin-left: 0; padding: 10px 0; font-size: 15px; border-bottom: 1px solid var(--border); width: 100%; }
            .main { padding: 24px 4%; }
        }
        @media (max-width: 480px) {
            h1 { font-size: 7vw; } h2 { font-size: 6vw; } h3 { font-size: 5vw; }
            nav { padding: 0 4%; }
            .main { padding: 16px 3%; }
            .lang-dropdown { margin-left: 0; }
        }
        @media (min-width: 1200px) {
            h1 { font-size: 2.5rem; } h2 { font-size: 2rem; } h3 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
<nav>
    <a href="/" class="nav-brand">TechMinimal</a>
    <button class="hamburger" onclick="toggleMenu()">☰</button>
    <div class="nav-links" id="navLinks">
        @auth
        <a href="/">{{ __('messages.home') }}</a>
        <a href="/catalog">{{ __('messages.catalog') }}</a>
        @role('customer')
        <a href="/cart">{{ __('messages.cart') }}</a>
        <a href="/payment">{{ __('messages.payment') }}</a>
        @endrole
        @role('seller')
        <a href="/products/create">{{ __('messages.add_product') }}</a>
        <a href="/analytics">{{ __('messages.analytics') }}</a>
        @endrole
        @role('manager|admin')
        <a href="/users">{{ __('messages.users') }}</a>
        @endrole
        <a href="/profile">{{ __('messages.profile') }}</a>
        <form method="POST" action="/logout" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;color:var(--muted);padding:0;margin-left:16px;font-size:13px;">{{ __('messages.logout') }}</button>
        </form>
        @else
        <a href="/login">{{ __('messages.login') }}</a>
        <a href="/register">{{ __('messages.register') }}</a>
        @endauth

        @php $locale = session('locale', 'en'); @endphp
        <div class="lang-dropdown" id="langDropdown">
            <button class="lang-dropdown-btn" onclick="toggleLang(event)">
                @switch($locale)
                @case('ru') 🇷🇺 RU @break
                @case('kk') 🇰🇿 KK @break
                @case('zh') 🇨🇳 ZH @break
                @default 🇺🇸 EN
                @endswitch
                ▾
            </button>
            <div class="lang-dropdown-menu" id="langMenu">
                <a href="/language/en" class="{{ $locale == 'en' ? 'active' : '' }}">🇺🇸 English</a>
                <a href="/language/ru" class="{{ $locale == 'ru' ? 'active' : '' }}">🇷🇺 Русский</a>
                <a href="/language/kk" class="{{ $locale == 'kk' ? 'active' : '' }}">🇰🇿 Қазақша</a>
                <a href="/language/zh" class="{{ $locale == 'zh' ? 'active' : '' }}">🇨🇳 中文</a>
            </div>
        </div>
    </div>
</nav>

<div class="main">
    @yield('content')
</div>

<footer>
    <div class="footer-grid">
        <div class="footer-col">
            <h4>TechMinimal</h4>
            <p style="color:var(--muted);font-size:13px;line-height:1.6;">{{ __('messages.footer_desc') }}</p>
        </div>
        <div class="footer-col">
            <h4>{{ __('messages.shop') }}</h4>
            <a href="/catalog">{{ __('messages.catalog') }}</a>
            @auth
            @role('customer')
            <a href="/cart">{{ __('messages.cart') }}</a>
            <a href="/payment">{{ __('messages.payment') }}</a>
            @endrole
            @endauth
        </div>
        <div class="footer-col">
            <h4>{{ __('messages.account') }}</h4>
            @auth
            <a href="/profile">{{ __('messages.profile') }}</a>
            @else
            <a href="/login">{{ __('messages.login') }}</a>
            <a href="/register">{{ __('messages.register') }}</a>
            @endauth
        </div>
        <div class="footer-col">
            <h4>{{ __('messages.contact') }}</h4>
            <a href="mailto:support@techminimal.com">support@techminimal.com</a>
            <a href="#">Almaty, Kazakhstan</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} TechMinimal. {{ __('messages.all_rights') }}</p>
        <p>{{ __('messages.built_with') }}</p>
    </div>
</footer>

<script>
    function toggleMenu() {
        document.getElementById('navLinks').classList.toggle('open');
    }

    function toggleLang(e) {
        e.stopPropagation();
        document.getElementById('langMenu').classList.toggle('open');
    }

    document.addEventListener('click', function() {
        document.getElementById('langMenu').classList.remove('open');
    });
</script>
</body>
</html>
