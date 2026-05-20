<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0284c7">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --sky-50: #ecfeff;
            --sky-100: #cffafe;
            --sky-200: #a5f3fc;
            --sky-300: #67e8f9;
            --sky-400: #22d3ee;
            --sky-500: #06b6d4;
            --sky-600: #0891b2;
            --sky-700: #0e7490;
            --sky-800: #155e75;
            --sky-900: #164e63;
            --leaf-500: #22c55e;
            --leaf-600: #16a34a;
            --ink: #0b1220;
            --muted: rgba(11, 18, 32, .72);
            --card: rgba(255, 255, 255, .74);
            --card-strong: rgba(255, 255, 255, .88);
            --border: rgba(2, 132, 199, .18);
            --shadow: 0 18px 50px rgba(2, 132, 199, .16);
            --radius: 18px;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }

        body.app-skin {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Liberation Sans", sans-serif;
            color: var(--ink);
            overflow-x: hidden;
            background:
                radial-gradient(1000px 500px at 10% 10%, rgba(34, 197, 94, .16), transparent 60%),
                radial-gradient(800px 420px at 90% 18%, rgba(6, 182, 212, .20), transparent 55%),
                linear-gradient(120deg, #e6fbff 0%, #dfffe6 35%, #c7f0ff 100%);
            background-size: 220% 220%;
            animation: skyDrift 16s ease-in-out infinite;
        }

        @keyframes skyDrift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @media (prefers-reduced-motion: reduce) {
            body.app-skin { animation: none; }
            .bg-wrap::before { animation: none !important; }
            .floaty { animation: none !important; transform: translate(-50%, -50%) !important; }
        }

        .bg-wrap {
            position: relative;
            min-height: 100vh;
        }

        .bg-wrap::before {
            content: "";
            position: absolute;
            inset: -2px;
            background:
                radial-gradient(circle at 20% 10%, rgba(255, 255, 255, .45) 0 2px, transparent 3px),
                radial-gradient(circle at 70% 25%, rgba(255, 255, 255, .35) 0 2px, transparent 3px),
                radial-gradient(circle at 40% 70%, rgba(255, 255, 255, .30) 0 2px, transparent 3px),
                radial-gradient(circle at 88% 62%, rgba(255, 255, 255, .28) 0 2px, transparent 3px);
            background-size: 420px 260px;
            opacity: .55;
            pointer-events: none;
            mix-blend-mode: soft-light;
            animation: sparkScroll 12s linear infinite;
        }

        @keyframes sparkScroll {
            0% { transform: translate3d(0, 0, 0); background-position: 0 0; }
            100% { transform: translate3d(-40px, 30px, 0); background-position: 420px 260px; }
        }

        .floaty-layer {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .floaty {
            position: absolute;
            left: var(--x, 50%);
            top: var(--y, 50%);
            width: var(--size, 180px);
            height: var(--size, 180px);
            transform: translate(-50%, -50%);
            background:
                radial-gradient(circle at 30% 30%,
                    rgba(255, 255, 255, .60),
                    rgba(34, 197, 94, .20) 35%,
                    rgba(6, 182, 212, .16) 60%,
                    transparent 70%);
            filter: blur(2px);
            opacity: .55;
            border-radius: 999px;
            animation: floaty var(--duration, 14s) ease-in-out infinite;
            animation-delay: var(--delay, 0s);
        }

        @keyframes floaty {
            0%, 100% { transform: translate(-50%, -50%) translate3d(0, 0, 0) scale(1); }
            50% { transform: translate(-50%, -50%) translate3d(0, -18px, 0) scale(1.06); }
        }

        .app-site-header {
            position: sticky;
            top: 0;
            z-index: 1030;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, .50);
            border-bottom: 1px solid rgba(2, 132, 199, .14);
        }

        .app-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            padding: 14px 0;
            position: relative;
            z-index: 2;
        }

        .app-header-inner > .navbar-brand { margin-right: 0; }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: inherit;
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(34, 197, 94, .22), rgba(6, 182, 212, .24));
            border: 1px solid rgba(2, 132, 199, .18);
            box-shadow: 0 10px 22px rgba(2, 132, 199, .14);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .brand-name {
            display: flex;
            flex-direction: column;
            line-height: 1.05;
            text-align: left;
        }

        .brand-name strong { font-size: 14px; letter-spacing: .2px; }
        .brand-name span { font-size: 12px; color: var(--muted); }

        .app-toggler {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: .45rem .65rem;
            background: rgba(255, 255, 255, .55);
        }

        .app-toggler:focus {
            box-shadow: 0 0 0 .2rem rgba(6, 182, 212, .25);
        }

        .app-nav-collapse {
            flex-basis: 100%;
            flex-grow: 1;
            align-items: center;
        }

        @media (min-width: 768px) {
            .app-nav-collapse {
                flex-basis: auto;
                flex-grow: 0;
            }
            .app-header-inner {
                flex-wrap: nowrap;
            }
        }

        .app-nav-collapse .navbar-nav {
            gap: 4px;
        }

        .app-nav-collapse .nav-link {
            color: rgba(11, 18, 32, .76) !important;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 12px !important;
            border-radius: 12px;
            transition: background .2s ease, color .2s ease, transform .2s ease;
        }

        .app-nav-collapse .nav-link:hover,
        .app-nav-collapse .nav-link:focus {
            background: rgba(255, 255, 255, .58);
            color: rgba(2, 132, 199, .95) !important;
            transform: translateY(-1px);
        }

        .app-nav-collapse .dropdown-menu {
            border-radius: 14px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            background: var(--card-strong);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .app-nav-collapse .dropdown-item {
            border-radius: 0;
        }

        .app-nav-collapse .dropdown-item:hover {
            background: rgba(6, 182, 212, .12);
            color: var(--ink);
        }

        .app-main {
            position: relative;
            z-index: 1;
        }

        #app { min-height: 100vh; display: flex; flex-direction: column; }
        #app > .bg-wrap { flex: 1; display: flex; flex-direction: column; }
        #app .app-main { flex: 1; }
    </style>
</head>
<body class="app-skin">
    <div id="app">
        <div class="bg-wrap">
            <div class="floaty-layer" aria-hidden="true">
                <div class="floaty" style="--x:12%; --y:18%; --size:170px; --duration:16s; --delay:-3s;"></div>
                <div class="floaty" style="--x:78%; --y:22%; --size:210px; --duration:18s; --delay:-7s;"></div>
                <div class="floaty" style="--x:88%; --y:62%; --size:180px; --duration:15s; --delay:-2s;"></div>
                <div class="floaty" style="--x:22%; --y:66%; --size:220px; --duration:20s; --delay:-9s;"></div>
                <div class="floaty" style="--x:50%; --y:78%; --size:160px; --duration:14s; --delay:-6s;"></div>
            </div>

            <header class="app-site-header">
                <nav class="navbar navbar-expand-md navbar-light p-0">
                    <div class="container app-header-inner">
                        <a class="navbar-brand brand p-0" href="{{ url('/') }}" aria-label="{{ config('app.name') }} home">
                            <span class="brand-mark" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 21s-7-4.35-7-10a7 7 0 0 1 14 0c0 5.65-7 10-7 10Z" stroke="#0284c7" stroke-width="2"/>
                                    <path d="M9.2 11.3 11 13l3.9-4.2" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="brand-name">
                                <strong>{{ config('app.name', 'Laravel') }}</strong>
                                <span>Nature-themed, sky-blue workspace</span>
                            </span>
                        </a>

                        <button class="navbar-toggler app-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse app-nav-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                @can('index visitors')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('visitors.index') }}">{{ __('Visitors') }}</a>
                                </li>
                                @endcan
                                @can ('create visitors')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('visitors.create') }}">{{ __('Visitor Create') }}</a>
                                </li>
                                @endcan
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                                </li>
                                <li class="nav-item d-none">
                                    <a class="nav-link" href="{{ route('users.create') }}">{{ __('User Create') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blogs.index') }}">{{ __('Blogs') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blogs.create') }}">{{ __('Blog Create') }}</a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown me-md-2">
                                        <a class="nav-link position-relative py-2" href="#" id="navbarNotificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ __('Notifications') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16" aria-hidden="true">
                                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                                            </svg>
                                            @if ($navbarUnreadCount > 0)
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                                                    {{ $navbarUnreadCount > 99 ? '99+' : $navbarUnreadCount }}
                                                </span>
                                            @endif
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end p-0 shadow" aria-labelledby="navbarNotificationDropdown" style="min-width: 20rem; max-width: 22rem;">
                                            <div class="px-3 py-2 border-bottom small fw-semibold text-muted">{{ __('Unread notifications') }}</div>
                                            <div style="max-height: 280px; overflow-y: auto;">
                                                @forelse ($navbarUnreadNotifications as $n)
                                                    <a class="dropdown-item py-2 px-3 border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}" href="{{ route('notifications.show', $n->id) }}">
                                                        <div class="small text-muted">{{ class_basename($n->type) }}</div>
                                                        <div class="text-truncate">{{ $n->data['message'] ?? json_encode($n->data) }}</div>
                                                        <div class="small text-muted">{{ $n->created_at->diffForHumans() }}</div>
                                                    </a>
                                                @empty
                                                    <div class="px-3 py-3 text-muted small">{{ __('No unread notifications.') }}</div>
                                                @endforelse
                                            </div>
                                            <div class="border-top bg-light">
                                                <a class="dropdown-item text-center fw-semibold py-2" href="{{ route('notifications.index') }}">{{ __('View all notifications') }}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                            <div class="small text-muted">
                                                {{ Auth::user()->lastLoginAt()->format('H:i:s') }} +8 hours
                                            </div>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('authentication-logs.index') }}">{{ __('Authentication Logs') }}</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <main class="app-main py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
