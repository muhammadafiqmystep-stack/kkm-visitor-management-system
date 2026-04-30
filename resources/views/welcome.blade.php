<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#0284c7" />
        <title>Visitor Registration System</title>
        <style>
            :root{
                --sky-50:#ecfeff;
                --sky-100:#cffafe;
                --sky-200:#a5f3fc;
                --sky-300:#67e8f9;
                --sky-400:#22d3ee;
                --sky-500:#06b6d4;
                --sky-600:#0891b2;
                --sky-700:#0e7490;
                --sky-800:#155e75;
                --sky-900:#164e63;
                --leaf-500:#22c55e;
                --leaf-600:#16a34a;
                --ink:#0b1220;
                --muted: rgba(11, 18, 32, .72);
                --card: rgba(255,255,255,.74);
                --card-strong: rgba(255,255,255,.88);
                --border: rgba(2,132,199,.18);
                --shadow: 0 18px 50px rgba(2,132,199,.16);
                --radius: 18px;
            }

            *{ box-sizing:border-box; }
            html,body{ height:100%; }
            body{
                margin:0;
                font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Liberation Sans", sans-serif;
                color:var(--ink);
                overflow-x:hidden;
                background:
                    radial-gradient(1000px 500px at 10% 10%, rgba(34, 197, 94, .16), transparent 60%),
                    radial-gradient(800px 420px at 90% 18%, rgba(6, 182, 212, .20), transparent 55%),
                    linear-gradient(120deg, #e6fbff 0%, #dfffe6 35%, #c7f0ff 100%);
                background-size: 220% 220%;
                animation: skyDrift 16s ease-in-out infinite;
            }

            @keyframes skyDrift{
                0%   { background-position: 0% 50%; }
                50%  { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            @media (prefers-reduced-motion: reduce){
                body{ animation:none; }
                .floaty{ animation:none !important; transform:none !important; }
                .shine{ animation:none !important; }
            }

            /* Animated background layers */
            .bg-wrap{
                position:relative;
                min-height:100vh;
            }

            .bg-wrap::before{
                content:"";
                position:absolute;
                inset:-2px;
                background:
                    radial-gradient(circle at 20% 10%, rgba(255,255,255,.45) 0 2px, transparent 3px),
                    radial-gradient(circle at 70% 25%, rgba(255,255,255,.35) 0 2px, transparent 3px),
                    radial-gradient(circle at 40% 70%, rgba(255,255,255,.30) 0 2px, transparent 3px),
                    radial-gradient(circle at 88% 62%, rgba(255,255,255,.28) 0 2px, transparent 3px);
                background-size: 420px 260px;
                opacity:.55;
                pointer-events:none;
                mix-blend-mode: soft-light;
                animation: sparkScroll 12s linear infinite;
            }
            @keyframes sparkScroll{
                0% { transform: translate3d(0,0,0); background-position: 0 0; }
                100% { transform: translate3d(-40px, 30px, 0); background-position: 420px 260px; }
            }

            .floaty-layer{
                position:absolute;
                inset:0;
                pointer-events:none;
            }

            .floaty{
                position:absolute;
                left: var(--x, 50%);
                top: var(--y, 50%);
                width: var(--size, 180px);
                height: var(--size, 180px);
                transform: translate(-50%,-50%);
                background:
                    radial-gradient(circle at 30% 30%,
                        rgba(255,255,255,.60),
                        rgba(34,197,94,.20) 35%,
                        rgba(6,182,212,.16) 60%,
                        transparent 70%);
                filter: blur(2px);
                opacity: .55;
                border-radius: 999px;
                animation: floaty var(--duration, 14s) ease-in-out infinite;
                animation-delay: var(--delay, 0s);
            }

            @keyframes floaty{
                0%,100% { transform: translate(-50%,-50%) translate3d(0,0,0) scale(1); }
                50% { transform: translate(-50%,-50%) translate3d(0,-18px,0) scale(1.06); }
            }

            .container{
                width:min(1100px, calc(100% - 40px));
                margin:0 auto;
                position:relative;
                z-index:1;
            }

            header{
                position:sticky;
                top:0;
                z-index:5;
                backdrop-filter: blur(10px);
                background: rgba(255,255,255,.50);
                border-bottom: 1px solid rgba(2,132,199,.14);
            }

            .nav{
                display:flex;
                align-items:center;
                justify-content:space-between;
                gap:14px;
                padding:14px 0;
            }

            .brand{
                display:flex;
                align-items:center;
                gap:10px;
                text-decoration:none;
                color:inherit;
            }

            .brand-mark{
                width:40px; height:40px;
                border-radius: 14px;
                background: linear-gradient(135deg, rgba(34,197,94,.22), rgba(6,182,212,.24));
                border: 1px solid rgba(2,132,199,.18);
                box-shadow: 0 10px 22px rgba(2,132,199,.14);
                display:grid;
                place-items:center;
            }

            .brand-name{
                display:flex;
                flex-direction:column;
                line-height:1.05;
            }

            .brand-name strong{ font-size: 14px; letter-spacing:.2px; }
            .brand-name span{ font-size: 12px; color: var(--muted); }

            nav a{
                color: rgba(11, 18, 32, .76);
                text-decoration:none;
                font-weight:600;
                font-size: 14px;
                padding:10px 12px;
                border-radius: 12px;
                transition: background .2s ease, color .2s ease, transform .2s ease;
            }
            nav a:hover{
                background: rgba(255,255,255,.58);
                color: rgba(2,132,199,.95);
                transform: translateY(-1px);
            }

            .hero{
                padding: 56px 0 28px;
            }

            .hero-grid{
                display:grid;
                grid-template-columns: 1.1fr .9fr;
                gap: 26px;
                align-items:stretch;
            }

            @media (max-width: 920px){
                .hero-grid{ grid-template-columns: 1fr; }
            }

            .badge{
                display:inline-flex;
                align-items:center;
                gap:10px;
                padding: 10px 14px;
                border-radius: 999px;
                background: rgba(255,255,255,.62);
                border: 1px solid rgba(2,132,199,.16);
                box-shadow: 0 12px 26px rgba(2,132,199,.10);
                font-weight: 700;
                color: rgba(2,132,199,.95);
                margin-bottom: 14px;
            }

            .badge svg{ flex:0 0 auto; }

            h1{
                margin:0;
                font-size: clamp(30px, 4.2vw, 52px);
                line-height:1.06;
                letter-spacing: -0.02em;
            }
            .subtitle{
                margin: 12px 0 0;
                color: var(--muted);
                font-size: 16px;
                line-height: 1.65;
                max-width: 60ch;
            }

            .cta-row{
                margin-top: 22px;
                display:flex;
                gap: 12px;
                flex-wrap: wrap;
                align-items:center;
            }

            .btn{
                display:inline-flex;
                align-items:center;
                justify-content:center;
                gap: 10px;
                padding: 12px 16px;
                border-radius: 14px;
                border: 1px solid rgba(2,132,199,.18);
                text-decoration:none;
                font-weight: 800;
                font-size: 14px;
                transition: transform .2s ease, box-shadow .2s ease, background .2s ease, border-color .2s ease;
                user-select:none;
            }

            .btn-primary{
                background: linear-gradient(135deg, rgba(6,182,212,.95), rgba(2,132,199,.95));
                color: white;
                box-shadow: 0 16px 38px rgba(2,132,199,.25);
                border-color: rgba(255,255,255,.25);
            }
            .btn-primary:hover{
                transform: translateY(-2px);
                box-shadow: 0 18px 48px rgba(2,132,199,.32);
            }

            .btn-ghost{
                background: rgba(255,255,255,.62);
                color: rgba(2,132,199,.95);
            }
            .btn-ghost:hover{
                transform: translateY(-2px);
                border-color: rgba(2,132,199,.30);
                background: rgba(255,255,255,.78);
            }

            .hero-card{
                border-radius: var(--radius);
                background: var(--card);
                border: 1px solid var(--border);
                box-shadow: var(--shadow);
                overflow:hidden;
                position:relative;
                padding: 18px;
                min-height: 260px;
            }

            .hero-card::after{
                content:"";
                position:absolute;
                inset:-120px;
                background: linear-gradient(110deg, transparent 0 35%, rgba(255,255,255,.55) 45%, transparent 55% 100%);
                transform: translateX(-60%) rotate(10deg);
                animation: shine 4.8s ease-in-out infinite;
                pointer-events:none;
            }

            @keyframes shine{
                0%{ opacity:.0; }
                25%{ opacity:.35; transform: translateX(-40%) rotate(10deg); }
                55%{ opacity:.20; transform: translateX(20%) rotate(10deg); }
                100%{ opacity:.0; transform: translateX(60%) rotate(10deg); }
            }

            .quick-stats{
                position:relative;
                z-index:1;
                display:grid;
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat{
                display:flex;
                gap:12px;
                align-items:flex-start;
                padding: 14px 14px;
                border-radius: 14px;
                background: rgba(255,255,255,.66);
                border: 1px solid rgba(2,132,199,.12);
            }

            .stat-icon{
                width:40px; height:40px;
                border-radius: 14px;
                display:grid;
                place-items:center;
                background: linear-gradient(135deg, rgba(34,197,94,.20), rgba(6,182,212,.20));
                border: 1px solid rgba(2,132,199,.18);
            }

            .stat strong{
                font-size: 14px;
                display:block;
                margin-bottom: 2px;
            }
            .stat span{
                color: var(--muted);
                font-size: 13px;
                line-height: 1.4;
            }

            section{
                padding: 34px 0;
            }

            .section-head{
                display:flex;
                align-items:flex-end;
                justify-content:space-between;
                gap:14px;
                margin-bottom: 18px;
            }

            .section-head h2{
                margin:0;
                font-size: 22px;
                letter-spacing:-0.01em;
            }

            .section-head p{
                margin:0;
                color: var(--muted);
                max-width: 60ch;
                line-height: 1.6;
                font-size: 14px;
            }

            .grid-3{
                display:grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 14px;
            }
            @media (max-width: 920px){
                .grid-3{ grid-template-columns: 1fr; }
            }

            .card{
                background: rgba(255,255,255,.70);
                border: 1px solid rgba(2,132,199,.14);
                border-radius: var(--radius);
                padding: 16px;
                box-shadow: 0 14px 34px rgba(2,132,199,.10);
                transition: transform .2s ease, border-color .2s ease, background .2s ease;
            }
            .card:hover{
                transform: translateY(-3px);
                border-color: rgba(2,132,199,.28);
                background: rgba(255,255,255,.82);
            }

            .card h3{
                margin: 10px 0 6px;
                font-size: 16px;
            }
            .card p{
                margin:0;
                color: var(--muted);
                line-height: 1.65;
                font-size: 14px;
            }

            .pill-row{
                display:flex;
                flex-wrap:wrap;
                gap: 10px;
                margin-top: 14px;
            }

            .pill{
                display:inline-flex;
                gap: 8px;
                align-items:center;
                padding: 10px 12px;
                border-radius: 999px;
                background: rgba(255,255,255,.62);
                border: 1px solid rgba(2,132,199,.14);
                color: rgba(11,18,32,.86);
                font-weight:800;
                font-size: 12.5px;
            }

            footer{
                padding: 26px 0 44px;
                color: rgba(11,18,32,.62);
                text-align:center;
            }

            .footer-divider{
                width:min(1100px, calc(100% - 40px));
                margin:0 auto 14px;
                border:0;
                height:1px;
                background: linear-gradient(90deg, transparent, rgba(2,132,199,.25), transparent);
            }

            /* Anchor offsets for sticky header */
            .anchor{ scroll-margin-top: 92px; }
        </style>
    </head>

    <body>
        <div class="bg-wrap">
            <div class="floaty-layer" aria-hidden="true">
                <div class="floaty" style="--x:12%; --y:18%; --size:170px; --duration:16s; --delay:-3s;"></div>
                <div class="floaty" style="--x:78%; --y:22%; --size:210px; --duration:18s; --delay:-7s;"></div>
                <div class="floaty" style="--x:88%; --y:62%; --size:180px; --duration:15s; --delay:-2s;"></div>
                <div class="floaty" style="--x:22%; --y:66%; --size:220px; --duration:20s; --delay:-9s;"></div>
                <div class="floaty" style="--x:50%; --y:78%; --size:160px; --duration:14s; --delay:-6s;"></div>
            </div>

            <header>
                <div class="container nav">
                    <a class="brand" href="#top" aria-label="Visitor Registration System home">
                        <div class="brand-mark" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M12 21s-7-4.35-7-10a7 7 0 0 1 14 0c0 5.65-7 10-7 10Z" stroke="#0284c7" stroke-width="2"/>
                                <path d="M9.2 11.3 11 13l3.9-4.2" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="brand-name">
                            <strong>Visitor Registration System</strong>
                            <span>Nature-themed, sky-blue landing</span>
                        </div>
                    </a>

                    <nav aria-label="Primary navigation">
                        <a href="#features">Features</a>
                        <a href="#quick-start">Quick Start</a>
                        <a href="#complaints">Complaints</a>
                        <a href="{{ route('home') }}">Home</a>
                    </nav>
                </div>
            </header>

            <main id="top" class="container hero">
                <div class="hero-grid">
                    <div>
                        <div class="badge">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 2l3 7 7 3-7 3-3 7-3-7-7-3 7-3 3-7Z" stroke="#0284c7" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                            Organized. Secure. Easy.
                        </div>

                        <h1>Welcome to Visitor Registration System</h1>
                        <p class="subtitle">
                            Register visitors, manage vehicle entries, and submit complaints in a clean, professional workflow.
                            Designed with a sky-blue nature theme to keep your experience calm and focused.
                        </p>

                        <div class="cta-row">
                            <a class="btn btn-primary" href="#quick-start">
                                Get Started
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M9 18 15 12 9 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <a class="btn btn-ghost" href="#features">
                                Explore Features
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 5v14" stroke="#0284c7" stroke-width="2" stroke-linecap="round"/>
                                    <path d="m19 12-7 7-7-7" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>

                        <div class="pill-row" aria-label="Highlights">
                            <div class="pill">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M20 6 9 17l-5-5" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Visitor records
                            </div>
                            <div class="pill">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M4 7h16" stroke="#0284c7" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M4 12h16" stroke="#0284c7" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M4 17h16" stroke="#0284c7" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                Vehicle management
                            </div>
                            <div class="pill">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 2a9 9 0 0 0-9 9c0 5 4 9 9 9s9-4 9-9a9 9 0 0 0-9-9Z" stroke="#0284c7" stroke-width="2"/>
                                    <path d="M12 17v-1" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M12 11a2 2 0 1 0-2-2" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                Complaint reporting
                            </div>
                        </div>
                    </div>

                    <aside class="hero-card" aria-label="System highlights">
                        <div class="quick-stats">
                            <div class="stat">
                                <div class="stat-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 19V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14" stroke="#0284c7" stroke-width="2" stroke-linejoin="round"/>
                                        <path d="M8 7h8" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M8 11h6" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M8 15h8" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <strong>Clear visitor flow</strong>
                                    <span>Track guest details and keep entries consistent.</span>
                                </div>
                            </div>

                            <div class="stat">
                                <div class="stat-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 16V9a3 3 0 0 1 3-3h8a3 3 0 0 1 3 3v7" stroke="#0284c7" stroke-width="2" stroke-linejoin="round"/>
                                        <path d="M7 16h10" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M9 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" fill="#16a34a"/>
                                        <path d="M15 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" fill="#16a34a"/>
                                    </svg>
                                </div>
                                <div>
                                    <strong>Vehicle records</strong>
                                    <span>Manage vehicle type and plate information at entry.</span>
                                </div>
                            </div>

                            <div class="stat">
                                <div class="stat-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 7 10 17l-5-5" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7 7h10v10" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <strong>Complaints made simple</strong>
                                    <span>Let visitors report issues clearly and quickly.</span>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </main>

            <section id="features" class="anchor">
                <div class="container">
                    <div class="section-head">
                        <div>
                            <h2>Features that keep things organized</h2>
                            <p>Everything you need for visitor management, designed for a professional and calm experience.</p>
                        </div>
                    </div>

                    <div class="grid-3">
                        <div class="card">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 20V10a2 2 0 0 1 2-2h5" stroke="#0284c7" stroke-width="2" stroke-linecap="round"/>
                                <path d="M15 20V4h5v16" stroke="#0284c7" stroke-width="2" stroke-linecap="round"/>
                                <path d="M9 10l2 2 4-4" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <h3>Visitor Registration</h3>
                            <p>Record visitor details with a structured, easy-to-scan format.</p>
                        </div>

                        <div class="card">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M3 13h18" stroke="#0284c7" stroke-width="2" stroke-linecap="round"/>
                                <path d="M5 13l2-6h10l2 6" stroke="#0284c7" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M8 20a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" fill="#16a34a"/>
                                <path d="M16 20a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" fill="#16a34a"/>
                            </svg>
                            <h3>Vehicle Management</h3>
                            <p>Keep vehicle type and registration details organized for every visit.</p>
                        </div>

                        <div class="card">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z" stroke="#0284c7" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M8 9h8" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                                <path d="M8 13h5" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <h3>Complaint Reporting</h3>
                            <p>Collect issues quickly and present them clearly for resolution.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="quick-start" class="anchor">
                <div class="container">
                    <div class="section-head">
                        <div>
                            <h2>Quick start</h2>
                            <p>Use this landing page to guide visitors on how the system works. (When you add routes, connect buttons to your forms.)</p>
                        </div>
                    </div>

                    <div class="grid-3">
                        <div class="card">
                            <h3>1. Register visitor</h3>
                            <p>Capture basic visitor information so staff can manage entry smoothly.</p>
                        </div>
                        <div class="card">
                            <h3>2. Add vehicle details</h3>
                            <p>Record vehicle type and registration to keep parking and access organized.</p>
                        </div>
                        <div class="card">
                            <h3>3. Submit a complaint</h3>
                            <p>Report concerns in a structured way for faster follow-up.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="complaints" class="anchor">
                <div class="container">
                    <div class="section-head">
                        <div>
                            <h2>Complaints</h2>
                            <p>A clean place for visitors to submit concerns. Add your real form route when it’s ready.</p>
                        </div>
                    </div>

                    <div class="card" style="padding: 18px; border-radius: calc(var(--radius) + 2px);">
                        <div style="display:flex; align-items:flex-start; gap:14px; flex-wrap:wrap;">
                            <div style="flex:1 1 320px;">
                                <h3 style="margin-top:0;">Simple, structured feedback</h3>
                                <p>
                                    Keep details clear: what happened, where it happened, and how it should be addressed.
                                    This landing page is styled to match your system theme and stays professional.
                                </p>
                            </div>

                            <div style="flex:0 0 auto; align-self:center;">
                                <a class="btn btn-primary" href="#top" title="Button placeholder until you add a complaint route">
                                    Submit Complaint
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M22 2 11 13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 2 15 22l-4-9-9-4 20-7Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <hr class="footer-divider" />
            <footer>
                Developed by Muhammad Afiq • Visitor Registration System
            </footer>
        </div>
    </body>
</html>