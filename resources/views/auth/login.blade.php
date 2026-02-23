<x-guest-layout>
    <div class="space-y-2 mb-10 text-center lg:text-left">
        <h2 class="font-display text-4xl font-black text-primary tracking-tighter">Welcome Back.</h2>
        <p class="text-primary/40 text-lg font-medium">Please enter your credentials to access your portal.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-8">
        @csrf

        <!-- Email Address -->
        <div class="space-y-3">
            <x-input-label for="email" :value="__('Corporate Email')"
                class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
            <x-text-input id="email"
                class="block w-full h-14 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-2xl px-6 font-bold text-primary shadow-sm"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="name@company.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-3">
            <div class="flex justify-between items-center px-2">
                <x-input-label for="password" :value="__('Access Key')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40" />
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black uppercase tracking-widest text-accent hover:text-primary transition-colors"
                        href="{{ route('password.request') }}">
                        {{ __('Recover Access?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password"
                class="block w-full h-14 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-2xl px-6 font-bold text-primary shadow-sm"
                type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="px-2">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="size-5 rounded-lg border-primary/10 text-accent shadow-sm focus:ring-accent bg-surface"
                    name="remember">
                <span
                    class="ms-3 text-xs font-bold text-primary/40 uppercase tracking-widest group-hover:text-primary transition-colors">{{ __('Stay Signed In') }}</span>
            </label>
        </div>

        <div class="pt-4 flex flex-col gap-6">
            <button type="submit"
                class="w-full h-16 bg-primary text-white font-black text-lg rounded-[2.5rem] shadow-2xl shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 active:scale-95 transition-all">
                {{ __('Open Secure Portal') }}
            </button>

            <p class="text-center text-sm font-bold text-primary/30 tracking-tight">
                New to the platform? <a href="{{ route('register') }}"
                    class="text-accent hover:text-primary underline underline-offset-4 transition-colors font-black uppercase tracking-widest text-xs ml-1">Request
                    Elite Access</a>
            </p>
        </div>
    </form>
</x-guest-layout>