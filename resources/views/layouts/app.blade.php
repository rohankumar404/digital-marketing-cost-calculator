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
            background: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Nav */
        header {
            background: rgba(26, 26, 26, 0.9);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--border);
            padding: 15px 5%;
            position: sticky;
            top: 0;
            z-index: 10000;
            /* Ensure it stays above everything */
            transition: var(--transition);
        }

        .nav-container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 32px;
            width: auto;
            object-fit: contain;
        }

        .nav-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            padding: 10px 22px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline {
            color: #fff;
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .btn-primary {
            background: var(--primary);
            color: #000;
        }

        .btn-primary:hover {
            background: var(--secondary);
            color: #fff;
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

<body>
    <header
        style="height: 100px; display: flex; align-items: center; background: rgba(0,0,0,0.3); border-bottom: 1px solid rgba(255,255,255,0.05); position: sticky; top: 0; z-index: 1000; backdrop-filter: blur(10px);">
        <div class="nav-container"
            style="width: 100%; max-width: 1400px; margin: 0 auto; padding: 0 50px; display: flex; justify-content: space-between; align-items: center;">
            <div class="logo-group" style="display: flex; align-items: center; gap: 50px;">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/img/Mapsily-wihte-logo.png" alt="Mapsily Logo" style="height: 42px;">
                    </a>
                </div>
                <nav class="nav-left">
                    <a href="{{ route('dashboard') }}"
                        style="color: #fff; text-decoration: none; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; opacity: 0.7; transition: 0.3s;"
                        onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">Dashboard</a>
                </nav>
            </div>

            <nav class="nav-actions" style="display: flex; align-items: center; gap: 30px;">
                <a href="https://mapsily.com" target="_blank" class="btn btn-primary"
                    style="background: #85f43a; color: #000; border-radius: 10px; padding: 12px 28px; font-size: 14px; font-weight: 900; box-shadow: 0 4px 20px rgba(133,244,58,0.2);">Visit
                    Mapsily.com <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="3" style="margin-left: 8px;">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3" />
                    </svg></a>
                @auth
                    <div style="display: flex; align-items: center; gap: 25px;">
                        <span style="color: #fff; font-size: 15px; font-weight: 600;">Hi,
                            {{ explode(' ', auth()->user()->name)[0] }}</span>
                        <a href="{{ route('profile.edit') }}"
                            style="color: #fff; opacity: 0.6; font-size: 13px; font-weight: 800; text-transform: uppercase; text-decoration: none;">Settings</a>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        style="color: #fff; opacity: 0.6; text-decoration: none; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Log
                        in</a>
                    <a href="{{ route('register') }}"
                        style="color: #fff; opacity: 0.6; text-decoration: none; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Register</a>
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
                <button class="btn btn-primary" style="padding: 18px 40px; font-size: 16px;" @click="openLead = true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    Book Free Strategy Call
                </button>
                <a href="#" class="btn btn-outline"
                    style="padding: 18px 40px; font-size: 16px; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.05);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                    </svg>
                    Upgrade to Premium
                </a>
            </div>
        </div>
    </section>

    {{-- Lead Modal --}}
    <div x-show="openLead" class="modal-overlay"
        style="position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 9999; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(8px);"
        x-cloak x-transition>

        <div class="card"
            style="width: 100%; max-width: 500px; text-align: left; position: relative; max-height: 90vh; overflow-y: auto;"
            @click.away="openLead = false">

            <button @click="openLead = false"
                style="position: absolute; top: 20px; right: 20px; background: transparent; border: none; color: #888; font-size: 24px; cursor: pointer;">&times;</button>

            <h3 style="font-size: 24px; font-weight: 700; color: #fff; margin-bottom: 10px;">Grow With Mapsily</h3>
            <p style="color: #666; font-size: 14px; margin-bottom: 30px;">Fill out the form below and our strategy
                expert will reach out within 24 hours.</p>

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
                    <div style="margin-bottom: 15px;">
                        <label
                            style="display: block; font-size: 12px; font-weight: 700; color: #888; margin-bottom: 5px; text-transform: uppercase;">Full
                            Name *</label>
                        <input type="text" x-model="formData.name" required
                            style="width: 100%; padding: 12px; border-radius: 10px; background: #333; border: 1px solid #444; color: #fff; outline: none; transition: 0.2s;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                        <div>
                            <label
                                style="display: block; font-size: 12px; font-weight: 700; color: #888; margin-bottom: 5px; text-transform: uppercase;">Work
                                Email *</label>
                            <input type="email" x-model="formData.email" required
                                style="width: 100%; padding: 12px; border-radius: 10px; background: #333; border: 1px solid #444; color: #fff;">
                        </div>
                        <div>
                            <label
                                style="display: block; font-size: 12px; font-weight: 700; color: #888; margin-bottom: 5px; text-transform: uppercase;">Phone
                                Number *</label>
                            <input type="text" x-model="formData.phone" required
                                style="width: 100%; padding: 12px; border-radius: 10px; background: #333; border: 1px solid #444; color: #fff;">
                        </div>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label
                            style="display: block; font-size: 12px; font-weight: 700; color: #888; margin-bottom: 5px; text-transform: uppercase;">Company
                            Name</label>
                        <input type="text" x-model="formData.company"
                            style="width: 100%; padding: 12px; border-radius: 10px; background: #333; border: 1px solid #444; color: #fff;">
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label
                            style="display: block; font-size: 12px; font-weight: 700; color: #888; margin-bottom: 5px; text-transform: uppercase;">Your
                            Message</label>
                        <textarea x-model="formData.message" rows="3"
                            style="width: 100%; padding: 12px; border-radius: 10px; background: #333; border: 1px solid #444; color: #fff; resize: none;"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px;"
                        x-bind:disabled="loading" x-text="loading ? 'Sending...' : 'Request Strategy Audit →'"></button>
                </div>

                <div x-show="success" x-transition class="text-center" style="padding: 20px 0;">
                    <div
                        style="width: 60px; height: 60px; background: rgba(133,244,58,0.1); color: #85f43a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 30px;">
                        ✓</div>
                    <h4 style="font-size: 20px; color: #fff; margin-bottom: 10px;">Enquiry Received!</h4>
                    <p style="color: #888; font-size: 14px; margin-bottom: 25px;">Thank you for your interest. Our
                        growth expert will review your business and reach out shortly.</p>
                    <button @click="openLead = false; success = false" class="btn btn-outline"
                        style="width: 100%;">Close Window</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    {{-- Background effect --}}
    <div
        style="position: absolute; top: -50%; left: -20%; width: 600px; height: 600px; background: rgba(133,244,58,0.03); border-radius: 50%; filter: blur(100px); pointer-events: none;">
    </div>
    <div
        style="position: absolute; bottom: -50%; right: -20%; width: 600px; height: 600px; background: rgba(133,244,58,0.03); border-radius: 50%; filter: blur(100px); pointer-events: none;">
    </div>
    </section>

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

    @stack('scripts')
</body>

</html>