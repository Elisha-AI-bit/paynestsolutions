<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>PayNestSolutions | Elite Digital Lending</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#0f172a",
                        "accent": "#10b981",
                        "surface": "#f8fafc",
                    },
                    fontFamily: {
                        "display": ["Outfit", "sans-serif"],
                        "sans": ["Inter", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-gradient {
            background: radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.15), transparent 40%), radial-gradient(circle at 20% 80%, rgba(15, 23, 42, 0.08), transparent 40%);
        }
    </style>
</head>

<body class="bg-surface font-sans text-primary antialiased">
    <div class="relative min-h-screen hero-gradient">
        <!-- Navigation -->
        <nav class="sticky top-0 z-50 glass px-6 py-4 border-b border-primary/5">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-primary p-2.5 rounded-2xl shadow-xl ring-1 ring-white/20">
                        <span class="material-symbols-outlined text-white text-2xl">account_balance</span>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl tracking-tight text-primary">PayNest<span
                            class="text-accent">Solutions</span></h2>
                </div>

                <div
                    class="hidden md:flex items-center gap-10 font-bold text-sm uppercase tracking-wider text-primary/60">
                    <a href="#how" class="hover:text-accent transition-colors">Process</a>
                    <a href="#products" class="hover:text-accent transition-colors">Products</a>
                    <a href="#contact" class="hover:text-accent transition-colors">Support</a>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-8 py-3 bg-primary text-white font-extrabold rounded-2xl shadow-2xl shadow-primary/30 hover:scale-105 active:scale-95 transition-all">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden sm:block text-primary/80 font-bold hover:text-primary transition-colors">Login</a>
                        <a href="#apply"
                            class="px-8 py-3 bg-accent text-white font-extrabold rounded-2xl shadow-2xl shadow-accent/30 hover:scale-105 active:scale-95 transition-all">
                            Apply Now
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero & Registration Section -->
        <main>
            <section class="max-w-7xl mx-auto px-6 py-12 lg:py-20 grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div
                        class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/50 border border-primary/5 shadow-sm text-primary/80 font-bold text-xs uppercase tracking-widest">
                        <span class="flex h-2 w-2 rounded-full bg-accent animate-pulse"></span>
                        Trusted by 12,000+ professionals
                    </div>
                    <h1 class="font-display text-5xl lg:text-7xl font-extrabold leading-[1.05] tracking-tight">
                        Modern Loans <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-primary">For Modern
                            Work.</span>
                    </h1>
                    <p class="text-lg text-primary/60 leading-relaxed max-w-xl font-medium">
                        Smart, risk-based lending tailored to your profession. Fast approvals, competitive rates, and no
                        hidden fees.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-5 pt-4">
                        <a href="#apply"
                            class="flex h-14 px-10 items-center justify-center rounded-2xl bg-primary text-white font-extrabold text-lg shadow-2xl shadow-primary/40 hover:-translate-y-1 hover:shadow-primary/50 transition-all">
                            Apply Now
                        </a>
                        <a href="#products"
                            class="group flex h-14 px-10 items-center justify-center rounded-2xl bg-white border-2 border-primary/5 font-bold text-base hover:border-accent transition-all text-primary/80">
                            Our Products
                            <span class="material-symbols-outlined ml-2 group-hover:translate-x-1 transition-transform">east</span>
                        </a>
                    </div>
                </div>

                <div id="apply" class="relative group">
                    <div
                        class="absolute -inset-10 bg-accent/5 rounded-full blur-[80px] -z-10 group-hover:bg-accent/10 transition-all duration-500">
                    </div>
                    <div
                        class="bg-white p-8 lg:p-10 rounded-[3rem] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] border border-primary/5">
                        <div class="mb-8">
                            <h2 class="font-display text-3xl font-black text-primary tracking-tight">Fast Application
                            </h2>
                            <p class="text-primary/40 font-medium">Create your elite account to start.</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="space-y-5">
                            @csrf

                            @if ($errors->any())
                                <div class="p-4 bg-red-50 border border-red-100 rounded-2xl">
                                    <ul class="list-disc list-inside text-xs font-bold text-red-500 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="grid md:grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2">Full
                                        Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                                        placeholder="John Doe">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2">Email
                                        Address</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                                        placeholder="john@example.com">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2">NRC
                                        Number</label>
                                    <input type="text" name="nrc" value="{{ old('nrc') }}" required
                                        class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                                        placeholder="000000/00/1">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2">Mobile
                                        Number</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required
                                        class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                                        placeholder="0970000000">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2">Employment
                                        Sector</label>
                                    <select name="employment_type" required
                                        class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-black text-xs uppercase tracking-widest text-primary shadow-sm">
                                        <option value="government" {{ old('employment_type') == 'government' ? 'selected' : '' }}>Government</option>
                                        <option value="marketer" {{ old('employment_type') == 'marketer' ? 'selected' : '' }}>Marketer</option>
                                        <option value="business" {{ old('employment_type') == 'business' ? 'selected' : '' }}>Business</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2">Monthly
                                        Income</label>
                                    <input type="number" name="monthly_income" value="{{ old('monthly_income') }}"
                                        required
                                        class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                                        placeholder="K10,000">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2">Set
                                        Password</label>
                                    <input type="password" name="password" required
                                        class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                                        placeholder="••••••••">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2">Confirm
                                        Password</label>
                                    <input type="password" name="password_confirmation" required
                                        class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                                        placeholder="••••••••">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full h-14 mt-4 bg-primary text-white font-black text-lg rounded-2xl shadow-xl shadow-primary/20 hover:shadow-primary/30 hover:-translate-y-0.5 active:scale-95 transition-all">
                                Apply & Continue
                            </button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Products -->
            <section id="products" class="bg-white py-24 px-6">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16 space-y-4">
                        <h2 class="font-display text-4xl lg:text-5xl font-extrabold tracking-tight">Tailored Categories
                        </h2>
                        <p class="text-primary/60 text-lg max-w-2xl mx-auto">We've designed our lending products to
                            match the financial realities of your career path.</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-10">
                        <!-- Government -->
                        <div class="group p-1 bg-surface rounded-[2.5rem] transition-all hover:scale-[1.02]">
                            <div
                                class="bg-white p-10 rounded-[2.4rem] h-full space-y-8 border border-primary/5 group-hover:shadow-2xl transition-all">
                                <span
                                    class="material-symbols-outlined text-5xl text-primary/20">account_balance_wallet</span>
                                <div class="space-y-4">
                                    <h3 class="font-display font-bold text-3xl tracking-tight">Government</h3>
                                    <p class="text-primary/50 leading-relaxed italic">"Secure & Stable"</p>
                                    <p class="text-primary/60 leading-relaxed text-sm">Preferred rates for public sector
                                        employees with flexible deduction-at-source options.</p>
                                </div>
                                <div class="h-px bg-primary/5 w-full"></div>
                                <div
                                    class="flex items-center justify-between text-xs font-black uppercase tracking-widest text-primary/40">
                                    <span>Rates from 5%</span>
                                    <span class="text-accent">Popular</span>
                                </div>
                            </div>
                        </div>

                        <!-- Marketer -->
                        <div class="group p-1 bg-surface rounded-[2.5rem] transition-all hover:scale-[1.02]">
                            <div
                                class="bg-white p-10 rounded-[2.4rem] h-full space-y-8 border border-primary/5 group-hover:shadow-2xl transition-all">
                                <span class="material-symbols-outlined text-5xl text-accent/30">monitoring</span>
                                <div class="space-y-4">
                                    <h3 class="font-display font-bold text-3xl tracking-tight text-accent">Marketer</h3>
                                    <p class="text-primary/50 leading-relaxed italic">"Dynamic & Scalable"</p>
                                    <p class="text-primary/60 leading-relaxed text-sm">Flexible repayments that align
                                        with your sales cycles and commission timings.</p>
                                </div>
                                <div class="h-px bg-primary/5 w-full"></div>
                                <div
                                    class="flex items-center justify-between text-xs font-black uppercase tracking-widest text-primary/40">
                                    <span>Syncs with Sales</span>
                                    <span>Growth</span>
                                </div>
                            </div>
                        </div>

                        <!-- Business -->
                        <div class="group p-1 bg-surface rounded-[2.5rem] transition-all hover:scale-[1.02]">
                            <div
                                class="bg-white p-10 rounded-[2.4rem] h-full space-y-8 border border-primary/5 group-hover:shadow-2xl transition-all">
                                <span class="material-symbols-outlined text-5xl text-primary/20">storefront</span>
                                <div class="space-y-4">
                                    <h3 class="font-display font-bold text-3xl tracking-tight">Business</h3>
                                    <p class="text-primary/50 leading-relaxed italic">"Strategic Capital"</p>
                                    <p class="text-primary/60 leading-relaxed text-sm">Supporting entrepreneurs with
                                        scaling capital and transparent, fair terms.</p>
                                </div>
                                <div class="h-px bg-primary/5 w-full"></div>
                                <div
                                    class="flex items-center justify-between text-xs font-black uppercase tracking-widest text-primary/40">
                                    <span>Scale Fast</span>
                                    <span>Zero Equity</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-primary pt-24 pb-12 px-6">
            <div class="max-w-7xl mx-auto space-y-24">
                <div class="grid md:grid-cols-4 gap-12">
                    <div class="col-span-2 space-y-8">
                        <div class="flex items-center gap-3">
                            <div class="bg-white/10 p-2 rounded-xl border border-white/20">
                                <span class="material-symbols-outlined text-white text-2xl">account_balance</span>
                            </div>
                            <h2 class="font-display font-extrabold text-2xl text-white">PayNest<span
                                    class="text-accent">Solutions</span></h2>
                        </div>
                        <p class="text-white/40 text-lg max-w-md">Empowering professionals with smart financial tools
                            and tailored loan solutions designed for the modern workforce.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-8 uppercase tracking-widest text-xs">Resources</h4>
                        <ul class="space-y-4 text-white/60">
                            <li><a href="#" class="hover:text-accent transition-colors">Documentation</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Developer API</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Risk Scoring</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-8 uppercase tracking-widest text-xs">Company</h4>
                        <ul class="space-y-4 text-white/60">
                            <li><a href="#" class="hover:text-accent transition-colors">About</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Contact</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Privacy Guide</a></li>
                        </ul>
                    </div>
                </div>
                <div class="h-px bg-white/5 w-full"></div>
                <div
                    class="flex flex-col md:flex-row justify-between items-center gap-6 text-white/30 text-xs font-bold uppercase tracking-[0.2em]">
                    <p>© 2024 PayNestSolutions. All rights reserved.</p>
                    <div class="flex gap-10">
                        <a href="#" class="hover:text-white transition-colors">Twitter</a>
                        <a href="#" class="hover:text-white transition-colors">LinkedIn</a>
                        <a href="#" class="hover:text-white transition-colors">Instagram</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>