<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="@yield('meta_description', 'Estimate your digital marketing costs instantly with Mapsily.')">
    <title>@yield('title', 'Marketing Cost Calculator – Mapsily')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;700&display=swap"
        rel="stylesheet">

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --bg: #1A1A1A;
            --bg-card: #242424;
            --bg-input: #2D2D2D;
            --primary: #85f43a;
            --secondary: #47A805;
            --text: #ffffff;
            --text-muted: #888888;
            --border: rgba(255, 255, 255, 0.08);
            --radius: 16px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            /* Globally apply the Dots architecture */
            background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 35px 35px;
            color: var(--text);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            overflow-x: hidden;
            /* Prevent global horizontal scroll */
            width: 100%;
        }

        /* Elite Header System */
        .elite-header {
            height: 90px;
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            position: sticky;
            top: 0;
            z-index: 10000;
            backdrop-filter: blur(15px);
        }

        .nav-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-group {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .logo img {
            height: 35px;
            width: auto;
            object-fit: contain;
            transition: 0.3s;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .nav-left-link {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.6;
            transition: 0.3s;
        }

        .nav-left-link:hover {
            opacity: 1;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-action-link {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.6;
            transition: 0.3s;
        }

        .nav-action-link:hover {
            opacity: 1;
        }

        .header-btn {
            background: var(--primary);
            color: #000;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 800;
            text-decoration: none;
            text-transform: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .header-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(133, 244, 58, 0.2);
            filter: brightness(1.05);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
        }

        /* Currency Switcher Styles */
        .currency-switcher {
            position: relative;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 5px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .currency-switcher:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .currency-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 10px;
            background: #222;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            width: 160px;
            z-index: 10001;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            display: none;
        }

        .currency-dropdown.active {
            display: block;
        }

        .currency-opt {
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #aaa;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s;
        }

        .currency-opt:hover {
            background: rgba(133, 244, 58, 0.1);
            color: #85f43a;
        }

        .currency-opt.active {
            color: #85f43a;
            background: rgba(133, 244, 58, 0.05);
        }

        /* Standardized Modal Centering Protocol */
        .elite-modal-overlay {
            position: fixed;
            inset: 0;
            display: grid;
            place-items: center;
            background: rgba(0, 0, 0, 0.94);
            z-index: 1000000;
            backdrop-filter: blur(20px);
            padding: 40px;
            overflow-y: auto;
        }

        /* Essential for Alpine x-show to work with grid */
        [x-cloak] { display: none !important; }

        .elite-modal-card {
            background: #1a1a1a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 45px;
            width: 100%;
            max-width: 550px;
            position: relative;
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.8);
        }

        /* Lead Form Integrity Classes */
        .elite-form-group {
            margin-bottom: 22px;
        }

        .elite-label {
            display: block;
            font-size: 10px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .elite-input {
            width: 100%;
            padding: 15px 20px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 14px;
            transition: 0.3s;
            outline: none;
            box-sizing: border-box;
        }

        .elite-input:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 20px rgba(133, 244, 58, 0.1);
        }

        .elite-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 22px;
        }

        @media (max-width: 600px) {
            .elite-grid { grid-template-columns: 1fr; }
            .elite-modal-card { padding: 30px; }
        }

        /* Footer */
        footer {
            background: #111;
            padding: 60px 5% 40px;
            margin-top: 80px;
            border-top: 1px solid var(--border);
        }

        .footer-grid {
            max-width: 1300px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 50px;
        }

        .footer-logo img {
            height: 35px;
            margin-bottom: 20px;
        }

        .footer-about {
            color: #888;
            font-size: 14px;
            max-width: 400px;
        }

        .footer-links h4 {
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        .footer-links a {
            display: block;
            color: #888;
            text-decoration: none;
            margin-bottom: 10px;
            font-size: 14px;
            transition: 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            max-width: 1300px;
            margin: 40px auto 0;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 12px;
            color: #555;
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
    @stack('styles')
</head>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('mapsily', {
            currency: localStorage.getItem('mapsily_currency') || 'USD',
            symbols: { USD: '$', INR: '₹', EUR: '€', GBP: '£', AED: 'د.إ', SAR: 'ر.س', QAR: 'ر.ق', KWD: 'د.ك' },
            rates: { USD: 1, INR: 83.2, EUR: 0.92, GBP: 0.79, AED: 3.67, SAR: 3.75, QAR: 3.64, KWD: 0.31 },
            setCurrency(c) {
                this.currency = c;
                localStorage.setItem('mapsily_currency', c);
            },
            format(amt) {
                let val = (amt || 0) * this.rates[this.currency];
                let symbol = this.symbols[this.currency];
                let formatted = Number(val).toLocaleString(undefined, {
                    minimumFractionDigits: (this.currency === 'KWD' ? 3 : 0), 
                    maximumFractionDigits: (this.currency === 'KWD' ? 3 : 0)
                });
                return symbol + formatted;
            }
        });
    });
</script>

<body x-data="{ openLead: false }">
    <header class="elite-header">
        <div class="nav-container">
            <div class="logo-group">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/img/Mapsily-wihte-logo.png" alt="Mapsily Logo">
                    </a>
                </div>
                <nav class="nav-left">
                    <a href="{{ route('dashboard') }}" class="nav-left-link">Dashboard</a>
                </nav>
            </div>

            <nav class="nav-actions" style="display: flex; align-items: center; gap: 20px;">
                {{-- Currency Switcher --}}
                <div x-data="{ dropdownOpen: false }" class="currency-switcher" @click.stop="dropdownOpen = !dropdownOpen">
                    <span style="font-size: 16px; color: #85f43a; font-weight: 800;" x-text="$store.mapsily.symbols[$store.mapsily.currency]"></span>
                    <span style="font-size: 12px; color: #fff; font-weight: 700; text-transform: uppercase;" x-text="$store.mapsily.currency"></span>
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="transition: 0.3s;" :style="dropdownOpen ? 'transform: rotate(180deg)' : ''">
                        <path d="M6 9l6 6 6-6" />
                    </svg>

                    <div class="currency-dropdown" :class="dropdownOpen ? 'active' : ''">
                        <template x-for="(symbol, code) in $store.mapsily.symbols">
                            <div class="currency-opt" :class="$store.mapsily.currency === code ? 'active' : ''" @click="$store.mapsily.setCurrency(code)">
                                <span style="font-size: 16px; width: 25px; text-align: center;" x-text="symbol"></span>
                                <span x-text="code"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <a href="https://mapsily.com" target="_blank" class="header-btn">
                    Visit Mapsily.com
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                        <polyline points="15 3 21 3 21 9" />
                        <line x1="10" y1="14" x2="21" y2="3" />
                    </svg>
                </a>
                @auth
                    <div style="display: flex; align-items: center; gap: 15px; background: rgba(255,255,255,0.05); padding: 5px 15px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.1);">
                        <span style="color: #85f43a; font-size: 13px; font-weight: 800; text-transform: uppercase;">Hi, {{ explode(' ', auth()->user()->name)[0] }}</span>
                        <div style="width: 1px; height: 12px; background: rgba(255,255,255,0.2);"></div>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; color: #ff4444; font-weight: 700; font-size: 13px;">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- CTA Section --}}
    <section style="padding: 100px 5%; position: relative; overflow: hidden;">
        <div
            style="max-width: 1100px; margin: 0 auto; background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center; border-radius: 30px; padding: 80px 40px; text-align: center; border: 1px solid rgba(255,255,255,0.05); box-shadow: 0 40px 100px rgba(0,0,0,0.5);">

            <div
                style="width: 60px; height: 60px; background: rgba(133,244,58,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; color: #85f43a;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 20V10M18 20V4M6 20v-4" />
                </svg>
            </div>

            <h2
                style="font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; color: #fff; margin-bottom: 20px; line-height: 1.1;">
                Need better performance? <br><span style="color: var(--primary);">Let Mapsily grow your brand.</span>
            </h2>

            <p style="color: #aaa; max-width: 700px; margin: 0 auto 40px; font-size: 1.1rem; line-height: 1.8;">
                Stop guessing what works. Our advanced growth analysts map your metrics directly against aggressive
                industry benchmarks building a personalized strategy engineered for scale.
            </p>

            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                <button class="header-btn" style="padding: 22px 50px; font-size: 16px; min-width: 250px; justify-content: center;" @click="openLead = true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-right: 12px;">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    Book Free Analysis
                </button>
                <a href="#" class="header-btn"
                    style="padding: 22px 50px; font-size: 16px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.15); color: #fff; min-width: 250px; justify-content: center;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-right: 12px;">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                    </svg>
                    Upgrade Account
                </a>
            </div>
        </div>
    </section>



    {{-- Atmosphere Glows (Contained) --}}
    <div
        style="position: absolute; top: -10%; left: -10%; width: 400px; height: 400px; background: rgba(133,244,58,0.02); border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0;">
    </div>
    <div
        style="position: absolute; bottom: 0; right: -10%; width: 500px; height: 500px; background: rgba(133,244,58,0.02); border-radius: 50%; filter: blur(120px); pointer-events: none; z-index: 0;">
    </div>

    <footer>
        <div class="footer-grid">
            <div>
                <a href="/" class="footer-logo">
                    <img src="/assets/img/Mapsily-wihte-logo.png" alt="Mapsily Logo">
                </a>
                <p class="footer-about">
                    Mapsily is a performance-driven digital marketing agency helping businesses scale with data-backed
                    strategies in SEO, PPC, and Social Media. Our calculator is designed to provide entrepreneurs with
                    transparent, realistic marketing investment forecasts.
                </p>
            </div>
            <div class="footer-links">
                <h4>Solutions</h4>
                <a href="https://mapsily.com/seo">Search Engine Optimization</a>
                <a href="https://mapsily.com/ppc">Google & Meta Ads</a>
                <a href="https://mapsily.com/social-media">Social Media Growth</a>
                <a href="https://mapsily.com/web-development">Web Development</a>
            </div>
            <div class="footer-links">
                <h4>Company</h4>
                <a href="https://mapsily.com/about">About Us</a>
                <a href="https://mapsily.com/contact">Contact</a>
                <a href="https://mapsily.com/case-studies">Case Studies</a>
                <a href="https://mapsily.com/blog">Marketing Blog</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} Mapsily. All rights reserved. | Built for modern businesses.
        </div>
    </footer>

    {{-- High-Fidelity Lead Modal --}}
    <div x-show="openLead" class="elite-modal-overlay" x-cloak x-transition>

        <div class="elite-modal-card" @click.stop>

            <button @click="openLead = false"
                style="position: absolute; top: 25px; right: 25px; background: none; border: none; color: #666; font-size: 32px; cursor: pointer; transition: 0.3s; z-index: 20;">&times;</button>

            <div style="margin-bottom: 30px;">
                <div style="display: inline-flex; align-items: center; gap: 8px; color: #85f43a; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 15px;">
                    <span style="width: 8px; height: 1px; background: #85f43a;"></span>
                    Elite Strategy Access
                </div>
                <h3 style="font-size: 32px; font-weight: 800; color: #fff; line-height: 1.1; margin-bottom: 10px;">Grow With Mapsily</h3>
                <p style="color: #666; font-size: 14px; line-height: 1.6;">Our strategy expert will evaluate your audit and reach out within 24 hours.</p>
            </div>

            <form x-data="{ 
                        loading: false, 
                        success: false,
                        formData: { name: '', email: '', phone: '', company: '', message: '' },
                        submitLead() {
                            this.loading = true;
                            fetch('{{ route('leads.store') }}', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                body: JSON.stringify(this.formData)
                            })
                            .then(res => res.json())
                            .then(data => {
                                this.loading = false;
                                if(data.success) {
                                    this.success = true;
                                    this.formData = { name: '', email: '', phone: '', company: '', message: '' };
                                }
                            });
                        }
                    }" @submit.prevent="submitLead()">

                <div x-show="!success">
                    <div class="elite-form-group">
                        <label class="elite-label">Full Name *</label>
                        <input type="text" x-model="formData.name" required placeholder="Enter name" class="elite-input">
                    </div>

                    <div class="elite-grid">
                        <div>
                            <label class="elite-label">Email Address *</label>
                            <input type="email" x-model="formData.email" required placeholder="work@company.com" class="elite-input">
                        </div>
                        <div>
                            <label class="elite-label">Phone Number *</label>
                            <input type="text" x-model="formData.phone" required placeholder="+1 (555) 000-0000" class="elite-input">
                        </div>
                    </div>

                    <div class="elite-form-group">
                        <label class="elite-label">Company Name (Optional)</label>
                        <input type="text" x-model="formData.company" placeholder="Business name" class="elite-input">
                    </div>

                    <div class="elite-form-group" style="margin-bottom: 30px;">
                        <label class="elite-label">Additional Context</label>
                        <textarea x-model="formData.message" rows="3" placeholder="Tell us about your project goals..." class="elite-input" style="resize: none;"></textarea>
                    </div>

                    <button type="submit" class="header-btn" style="width: 100%; justify-content: center; padding: 18px;" x-bind:disabled="loading">
                        <span x-show="!loading">Initialize Strategy Request →</span>
                        <span x-show="loading">Securing Connection...</span>
                    </button>
                </div>

                <div x-show="success" x-transition class="text-center" style="padding: 40px 0;">
                    <div
                        style="width: 80px; height: 80px; background: rgba(133,244,58,0.1); color: #85f43a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; font-size: 40px;">
                        ✓</div>
                    <h4 style="font-size: 24px; color: #fff; margin-bottom: 10px;">Enquiry Received!</h4>
                    <p style="color: #888; font-size: 16px; margin-bottom: 40px;">Our growth expert will reach out
                        within 24 hours.</p>
                    <button @click="openLead = false; success = false" class="header-btn"
                        style="width: 100%; justify-content: center; background: #333; color: #fff;">Close
                        Window</button>
                </div>
            </form>
        </div>
    </div>

    @stack('scripts')
</body>

</html>