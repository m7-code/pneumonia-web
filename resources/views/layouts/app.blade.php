<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PneumoFusion')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('lung-removebg-preview.png') }}">

    
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        font-family: Arial, sans-serif;
    }

    :root {
        --bg: #f5f5f5;
        --card: rgba(255, 255, 255, 0.75);
        --text: #000;
        --border: rgba(0, 0, 0, 0.1);
    }

    body.dark {
        --bg: #0f0f0f;
        --card: rgba(255, 255, 255, 0.08);
        --text: #fff;
        --border: rgba(255, 255, 255, 0.2);
    }

    body {
        background: var(--bg);
        color: var(--text);
        transition: 0.3s ease;
        min-height: 100vh;
        padding: 20px;
    }

    .hero {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
    }

    .card {
        position: relative;
        width: 100%;
        background: var(--card);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        border: 1px solid var(--border);
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        padding: 80px 30px 30px 30px;
        min-height: 85vh;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        transform-style: preserve-3d;
    }

    .card:hover {
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    }

    /* TOP BAR */
    .top-bar {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 20px 30px;
        z-index: 100;
    }

    .top-left {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--text);
    }

    .top-left a {
        color: var(--text);
        text-decoration: none;
    }

    /* TOP RIGHT */
    .top-right {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 20px;
        flex-wrap: nowrap;
    }

    .top-right a,
    .top-right span {
        color: var(--text);
        text-decoration: none;
        position: relative;
        font-size: 1rem;
        white-space: nowrap;
        line-height: 1;
    }

    .top-right a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 0;
        height: 2px;
        background: var(--text);
        transition: 0.3s ease;
    }

    .top-right a:hover::after {
        width: 100%;
    }

    /* AUTH LINKS */
    .auth-links {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 20px;
        flex-wrap: nowrap;
    }

    .auth-btn {
        background: none;
        border: none;
        color: var(--text);
        font-size: 1rem;
        cursor: pointer;
        padding: 0;
        position: relative;
        font-family: Arial, sans-serif;
        white-space: nowrap;
        line-height: 1;
    }

    .auth-btn::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 0;
        height: 2px;
        background: var(--text);
        transition: 0.3s ease;
    }

    .auth-btn:hover::after {
        width: 100%;
    }

    /* TOGGLE SWITCH */
    .toggle-switch {
        width: 56px;
        height: 28px;
        border-radius: 50px;
        background: #e0e0e0;
        position: relative;
        cursor: pointer;
        transition: background 0.3s ease;
        border: none;
        padding: 0;
        outline: none;
        box-shadow: inset 0 2px 6px rgba(0,0,0,0.15);
        flex-shrink: 0;
    }

    .toggle-switch.dark-active {
        background: linear-gradient(135deg, #4a0080, #7b2fff);
        box-shadow: inset 0 2px 6px rgba(0,0,0,0.3), 0 0 12px rgba(123,47,255,0.4);
    }

    .toggle-knob {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: white;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .toggle-switch.dark-active .toggle-knob {
        transform: translateX(28px);
        background: white;
        box-shadow: 0 0 8px rgba(200,100,255,0.6), 0 2px 6px rgba(0,0,0,0.3);
    }

    /* 3-DOT MOBILE MENU */
    .mobile-menu-btn {
        display: none;
        background: none;
        border: 1px solid var(--border);
        color: var(--text);
        font-size: 1.3rem;
        cursor: pointer;
        padding: 4px 10px;
        border-radius: 10px;
        line-height: 1;
        flex-shrink: 0;
    }

    .dropdown-wrapper {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 38px;
        right: 0;
        background: var(--card);
        backdrop-filter: blur(12px);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 10px;
        flex-direction: column;
        gap: 6px;
        min-width: 140px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        z-index: 9999;
    }

    .dropdown-menu.open {
        display: flex;
    }

    .dropdown-menu a,
    .dropdown-menu button {
        color: var(--text);
        text-decoration: none;
        font-size: 0.95rem;
        padding: 8px 12px;
        border-radius: 8px;
        background: none;
        border: none;
        cursor: pointer;
        font-family: Arial, sans-serif;
        text-align: left;
        width: 100%;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .dropdown-menu a:hover,
    .dropdown-menu button:hover {
        background: rgba(102,126,234,0.12);
    }

    .dropdown-username {
        padding: 8px 12px;
        font-size: 0.85rem;
        opacity: 0.6;
        border-bottom: 1px solid var(--border);
        margin-bottom: 4px;
    }

    /* NAV */
    .nav {
        margin-top: 30px;
        margin-bottom: 40px;
        display: flex;
        justify-content: center;
        gap: 50px;
    }

    .nav a {
        font-size: 1.2rem;
        text-decoration: none;
        color: var(--text);
        position: relative;
    }

    .nav a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 0;
        height: 2px;
        background: var(--text);
        transition: 0.3s ease;
    }

    .nav a:hover::after,
    .nav a.active::after {
        width: 100%;
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        body {
            padding: 15px;
        }
        .card {
            min-height: auto;
        }
    }

    @media (max-width: 768px) {
        body {
            padding: 10px;
        }

        .card {
            min-height: 100vh;
            padding: 70px 20px 20px 20px;
        }

        .top-bar {
            padding: 15px 20px;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .top-left {
            font-size: 1.2rem;
        }

        .top-right {
            flex-direction: row;
            align-items: center;
            gap: 12px;
            flex-wrap: nowrap;
        }

        /* Desktop auth hide on mobile */
        .auth-links {
            display: none;
        }

        /* 3-dot button show on mobile */
        .mobile-menu-btn {
            display: block;
        }

        .nav {
            margin-top: 20px;
            gap: 25px;
            flex-wrap: wrap;
            font-size: 1rem;
        }
    }
    </style>

    @stack('styles')
</head>
<body>
    <div class="hero">
        <div class="card">

            <!-- TOP BAR -->
            <div class="top-bar">

                <!-- LEFT: Logo -->
                <div class="top-left">
                    <a href="{{ route('home') }}">PneumoFusion</a>
                </div>

                <!-- RIGHT: Auth + Toggle -->
                <div class="top-right">

                    <!-- Desktop: Login/Signup OR Name/Logout -->
                    <div class="auth-links" id="desktopAuth">
                        @auth
                            <span>{{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline; margin:0;">
                                @csrf
                                <button type="submit" class="auth-btn">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Signup</a>
                        @endauth
                    </div>

                    <!-- Mobile: 3-dot button + dropdown -->
                    <div class="dropdown-wrapper">
                        <button class="mobile-menu-btn" id="mobileMenuBtn" onclick="toggleMobileMenu()">⋮</button>
                        <div class="dropdown-menu" id="dropdownMenu">
                            @auth
                                <div class="dropdown-username">{{ Auth::user()->name }}</div>
                                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}">Signup</a>
                            @endauth
                        </div>
                    </div>

                    <!-- Toggle Switch (always visible) -->
                    <button class="toggle-switch" id="toggleSwitch" onclick="toggleMode()" aria-label="Toggle dark mode">
                        <div class="toggle-knob"></div>
                    </button>

                </div>
            </div>

            <!-- NAV -->
            <div class="nav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('results') }}" class="{{ request()->routeIs('results') ? 'active' : '' }}">Result</a>
            </div>

            <!-- PAGE CONTENT -->
            @yield('content')

        </div>
    </div>

    <script>
    function toggleMode() {
        document.body.classList.toggle("dark");
        const toggle = document.getElementById("toggleSwitch");
        if (document.body.classList.contains("dark")) {
            toggle.classList.add("dark-active");
            localStorage.setItem("theme", "dark");
        } else {
            toggle.classList.remove("dark-active");
            localStorage.setItem("theme", "light");
        }
    }

    function toggleMobileMenu() {
        const menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("open");
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", (e) => {
        const btn = document.getElementById("mobileMenuBtn");
        const menu = document.getElementById("dropdownMenu");
        if (menu && btn && !btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.remove("open");
        }
    });

    // Apply saved theme on page load
    document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = localStorage.getItem("theme");
        const toggle = document.getElementById("toggleSwitch");
        if (savedTheme === "dark") {
            document.body.classList.add("dark");
            toggle.classList.add("dark-active");
        }
    });
    </script>

    @stack('scripts')
</body>
</html>