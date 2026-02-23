<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PayNest') }} | Access Gateway</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
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
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-surface text-primary selection:bg-accent/30 selection:text-primary">
    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Left Pane: Branding & Visuals (Hidden on small screens) -->
        <aside class="hidden lg:flex lg:w-1/2 relative bg-primary overflow-hidden items-center justify-center p-20">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop"
                    class="w-full h-full object-cover opacity-30 grayscale hover:grayscale-0 transition-all duration-1000"
                    alt="Financial Background">
                <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary/80 to-transparent"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 max-w-lg space-y-12">
                <a href="/" class="flex items-center gap-4 group">
                    <div
                        class="bg-white/10 p-4 rounded-3xl ring-1 ring-white/20 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-accent text-4xl">account_balance</span>
                    </div>
                    <div>
                        <h1 class="font-display font-black text-4xl text-white tracking-tighter italic">Pay<span
                                class="text-accent">Nest</span></h1>
                        <p class="text-xs font-black uppercase tracking-[0.3em] text-white/30">Secure Capital Gateway
                        </p>
                    </div>
                </a>

                <div class="space-y-6">
                    <h2 class="font-display text-5xl font-extrabold text-white leading-tight">Empowering the <br /><span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-emerald-400">Modern
                            Professional.</span></h2>
                    <p class="text-white/50 text-xl font-medium leading-relaxed">Join thousands of professionals
                        securing their financial future with our intelligent lending ecosystem.</p>
                </div>

                <div class="flex items-center gap-8 pt-10">
                    <div class="space-y-1">
                        <p class="text-3xl font-black text-white">12k+</p>
                        <p class="text-[10px] font-black uppercase tracking-widest text-white/20">Verified Users</p>
                    </div>
                    <div class="w-px h-12 bg-white/10"></div>
                    <div class="space-y-1">
                        <p class="text-3xl font-black text-white">98%</p>
                        <p class="text-[10px] font-black uppercase tracking-widest text-white/20">Trust Index</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Note -->
            <div
                class="absolute bottom-12 left-20 right-20 flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-white/20">
                <span>© 2026 PayNestSolutions</span>
                <span>Elite Network v2.4</span>
            </div>
        </aside>

        <!-- Right Pane: Authentication Form -->
        <main class="flex-1 flex flex-col items-center justify-center p-8 lg:p-24 bg-white relative">
            <!-- Mobile Branding -->
            <div class="lg:hidden mb-12 flex flex-col items-center gap-4">
                <div class="bg-primary p-3 rounded-2xl shadow-xl">
                    <span class="material-symbols-outlined text-white text-3xl">account_balance</span>
                </div>
                <h2 class="font-display font-black text-2xl italic text-primary tracking-tighter">Pay<span
                        class="text-accent">Nest</span></h2>
            </div>

            <div class="w-full max-w-md space-y-10">
                {{ $slot }}
            </div>

            <!-- Footer Links -->
            <footer class="mt-20 flex gap-10 text-[10px] font-black uppercase tracking-[0.2em] text-primary/20">
                <a href="#" class="hover:text-accent transition-colors">Privacy Privacy</a>
                <a href="#" class="hover:text-accent transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-accent transition-colors">Support Hub</a>
            </footer>
        </main>

    </div>
</body>

</html>