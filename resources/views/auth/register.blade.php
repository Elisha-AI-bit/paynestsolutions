<x-guest-layout>
    <div class="space-y-2 mb-10 text-center lg:text-left">
        <h2 class="font-display text-4xl font-black text-primary tracking-tighter">Join the Elite.</h2>
        <p class="text-primary/40 text-lg font-medium">Create your secure financial account in minutes.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="space-y-3">
                <x-input-label for="name" :value="__('Full Name')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
                <x-text-input id="name"
                    class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                    type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email Address -->
            <div class="space-y-3">
                <x-input-label for="email" :value="__('Email Address')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
                <x-text-input id="email"
                    class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                    type="email" name="email" :value="old('email')" required placeholder="john@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- NRC -->
            <div class="space-y-3">
                <x-input-label for="nrc" :value="__('NRC Number')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
                <x-text-input id="nrc"
                    class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                    type="text" name="nrc" :value="old('nrc')" required placeholder="000000/00/1" />
                <x-input-error :messages="$errors->get('nrc')" class="mt-1" />
            </div>

            <!-- Phone Number -->
            <div class="space-y-3">
                <x-input-label for="phone" :value="__('Mobile Number')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
                <x-text-input id="phone"
                    class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                    type="text" name="phone" :value="old('phone')" required placeholder="0970000000" />
                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Employment Type -->
            <div class="space-y-3">
                <x-input-label for="employment_type" :value="__('Employment Sector')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
                <select id="employment_type" name="employment_type"
                    class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-black text-xs uppercase tracking-widest text-primary shadow-sm transition-all"
                    required>
                    <option value="government">{{ __('Government') }}</option>
                    <option value="marketer">{{ __('Marketer') }}</option>
                    <option value="business">{{ __('Business') }}</option>
                </select>
                <x-input-error :messages="$errors->get('employment_type')" class="mt-1" />
            </div>

            <!-- Monthly Income -->
            <div class="space-y-3">
                <x-input-label for="monthly_income" :value="__('Avg. Monthly Income')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
                <x-text-input id="monthly_income"
                    class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                    type="number" name="monthly_income" :value="old('monthly_income')" required placeholder="K10,000" />
                <x-input-error :messages="$errors->get('monthly_income')" class="mt-1" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
            <!-- Password -->
            <div class="space-y-3">
                <x-input-label for="password" :value="__('Set Password')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
                <x-text-input id="password"
                    class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                    type="password" name="password" required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-3">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                    class="text-[10px] font-black uppercase tracking-widest text-primary/40 px-2" />
                <x-text-input id="password_confirmation"
                    class="block w-full h-12 bg-surface border-primary/5 focus:border-accent focus:ring-accent rounded-xl px-4 font-bold text-primary shadow-sm"
                    type="password" name="password_confirmation" required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <div class="pt-8 flex flex-col gap-6">
            <button type="submit"
                class="w-full h-16 bg-primary text-white font-black text-lg rounded-[2.5rem] shadow-2xl shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 active:scale-95 transition-all">
                {{ __('Create Elite Account') }}
            </button>

            <p class="text-center text-sm font-bold text-primary/30 tracking-tight uppercase tracking-widest text-xs">
                Already registered? <a href="{{ route('login') }}"
                    class="text-accent hover:text-primary underline underline-offset-4 transition-colors font-black ml-1">Secure
                    Sign In</a>
            </p>
        </div>
    </form>
</x-guest-layout>