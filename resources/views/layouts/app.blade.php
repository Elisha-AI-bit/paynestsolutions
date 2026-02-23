<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-surface text-primary selection:bg-accent/30 selection:text-primary">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-50 w-72 bg-primary flex flex-col transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <!-- Branding -->
            <div class="p-8 pb-12 flex items-center gap-3">
                <div class="bg-white/10 p-2.5 rounded-2xl ring-1 ring-white/20">
                    <span class="material-symbols-outlined text-accent text-2xl">account_balance</span>
                </div>
                <h2 class="font-display font-black text-2xl tracking-tight text-white italic">Pay<span
                        class="text-accent/80">Nest</span></h2>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 space-y-2 overflow-y-auto custom-scrollbar">
                <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-white/30 mb-4">Core Platform</p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-accent/10 text-accent ring-1 ring-accent/20' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-accent/10 text-accent ring-1 ring-accent/20' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <span class="material-symbols-outlined">admin_panel_settings</span>
                        Command Center
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.users.index') ? 'bg-accent/10 text-accent ring-1 ring-accent/20' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <span class="material-symbols-outlined">group</span>
                        User Inventory
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.products.index') ? 'bg-accent/10 text-accent ring-1 ring-accent/20' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <span class="material-symbols-outlined">inventory_2</span>
                        Product Hub
                    </a>

                    <a href="{{ route('admin.loans.index') }}"
                        class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.loans.index') ? 'bg-accent/10 text-accent ring-1 ring-accent/20' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <span class="material-symbols-outlined">history</span>
                        Capital Archive
                    </a>
                @endif

                <div class="pt-8">
                    <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-white/30 mb-4">Account</p>
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold transition-all {{ request()->routeIs('profile.edit') ? 'bg-accent/10 text-accent ring-1 ring-accent/20' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <span class="material-symbols-outlined">person</span>
                        Account Settings
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-white/40 hover:bg-red-500/10 hover:text-red-400 transition-all">
                            <span class="material-symbols-outlined">logout</span>
                            Sign Out
                        </button>
                    </form>
                </div>
            </nav>

            <!-- User Brief -->
            <div class="p-6 mt-auto">
                <div class="p-5 rounded-3xl bg-white/5 border border-white/5 space-y-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="size-10 rounded-xl bg-accent flex items-center justify-center font-display font-black text-primary">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="font-bold text-white text-sm truncate">{{ Auth::user()->name }}</span>
                            <span
                                class="text-[10px] uppercase font-black tracking-widest text-accent">{{ Auth::user()->role }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex flex-1 flex-col min-w-0 bg-surface overflow-hidden">
            <!-- Top Mobile Bar -->
            <header
                class="lg:hidden h-16 bg-white border-b border-primary/5 px-6 flex items-center justify-between shrink-0">
                <h2 class="font-display font-black text-xl italic text-primary">Pay<span class="text-accent">Nest</span>
                </h2>
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-primary/60">
                    <span class="material-symbols-outlined">menu_open</span>
                </button>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto overflow-x-hidden">
                {{ $slot }}
            </main>
        </div>

        <!-- Overlay for mobile sidebar -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-primary/40 backdrop-blur-sm lg:hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>
    </div>
</body>

</html>