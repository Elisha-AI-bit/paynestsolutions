<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Configure Your Loan | PayNestSolutions</title>
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
            background: radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.1), transparent 40%), radial-gradient(circle at 20% 80%, rgba(15, 23, 42, 0.05), transparent 40%);
        }
    </style>
</head>

<body class="bg-surface font-sans text-primary antialiased hero-gradient min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="glass px-6 py-4 border-b border-primary/5">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-primary p-2.5 rounded-2xl shadow-xl ring-1 ring-white/20">
                    <span class="material-symbols-outlined text-white text-2xl">account_balance</span>
                </div>
                <h2 class="font-display font-extrabold text-2xl tracking-tight text-primary">PayNest<span
                        class="text-accent">Solutions</span></h2>
            </div>
            <div class="flex items-center gap-4">
                <div
                    class="hidden sm:flex items-center gap-2 text-primary/40 text-xs font-black uppercase tracking-widest">
                    <span class="material-symbols-outlined text-sm">lock</span>
                    Secure Session
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 flex items-center justify-center p-6 lg:p-12">
        <div class="max-w-5xl w-full grid lg:grid-cols-5 gap-12 items-start">

            <!-- Left: Welcome & Context -->
            <div class="lg:col-span-2 space-y-8 py-8">
                <div
                    class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-accent/10 border border-accent/20 text-accent font-black text-[10px] uppercase tracking-widest">
                    <span class="flex h-2 w-2 rounded-full bg-accent animate-pulse"></span>
                    Step 2: Capital Configuration
                </div>
                <div class="space-y-4">
                    <h1 class="font-display text-5xl font-black leading-tight tracking-tighter">
                        Welcome, <br />
                        <span class="text-accent">{{ explode(' ', $user->name)[0] }}</span>
                    </h1>
                    <p class="text-lg text-primary/60 leading-relaxed font-medium">
                        Your account is verified. Now, let's configure your capital request. Select a product and adjust
                        the amount to see your personalized terms.
                    </p>
                </div>

                <div class="space-y-6 pt-8">
                    <div class="flex items-start gap-4">
                        <div
                            class="size-10 rounded-xl bg-white border border-primary/5 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-accent text-xl">verified_user</span>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-primary">High Trust Index</p>
                            <p class="text-xs text-primary/40">Risk score: {{ $user->risk_score }}/100</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div
                            class="size-10 rounded-xl bg-white border border-primary/5 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-primary/30 text-xl">payments</span>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-primary">K{{ number_format($maxEligible / 1000, 1) }}k
                                Eligible</p>
                            <p class="text-xs text-primary/40">Based on your monthly income</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Calculator -->
            <div class="lg:col-span-3">
                <div
                    class="bg-white p-8 lg:p-10 rounded-[3rem] shadow-[0_48px_80px_-16px_rgba(0,0,0,0.08)] border border-primary/5">
                    <form id="loan-form" action="{{ route('loans.store') }}" method="POST" class="space-y-10">
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

                        <!-- Product Selection -->
                        <div class="space-y-6">
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30 px-2">Select
                                Loan Type</label>
                            <div class="grid md:grid-cols-2 gap-4">
                                @forelse($products as $product)
                                    <label class="cursor-pointer group relative">
                                        <input type="radio" name="loan_product_id" value="{{ $product->id }}"
                                            class="hidden peer" {{ $loop->first ? 'checked' : '' }}>
                                        <div
                                            class="h-full p-6 rounded-3xl border-2 border-primary/5 bg-surface transition-all peer-checked:bg-white peer-checked:border-accent peer-checked:ring-4 peer-checked:ring-accent/5">
                                            <p class="font-display font-bold text-lg text-primary mb-1">{{ $product->name }}
                                            </p>
                                            <p class="text-[10px] font-black uppercase tracking-widest text-primary/30">Max
                                                K{{ number_format($product->max_amount, 0) }}</p>

                                            <!-- Indicator dot -->
                                            <div
                                                class="absolute top-4 right-4 size-2 rounded-full bg-primary/10 peer-checked:bg-accent">
                                            </div>
                                        </div>
                                    </label>
                                @empty
                                    <div
                                        class="col-span-2 p-10 border-2 border-dashed border-primary/5 rounded-3xl text-center opacity-40">
                                        <span class="material-symbols-outlined text-4xl mb-2">work_off</span>
                                        <p class="text-xs font-black uppercase tracking-widest">No tailored products found
                                            for your sector</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Amount Input -->
                        <div class="space-y-6">
                            <label
                                class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30 px-2">Borrowing
                                Amount</label>
                            <div class="relative group">
                                <div
                                    class="absolute left-6 top-1/2 -translate-y-1/2 font-display font-black text-2xl text-primary transition-colors group-focus-within:text-accent">
                                    K</div>
                                <input type="number" name="amount" id="amount-input" min="1000" max="{{ $maxEligible }}"
                                    step="1" value="1000"
                                    class="block w-full h-20 bg-surface border-2 border-primary/5 focus:border-accent focus:ring-accent rounded-3xl pl-12 pr-6 font-display font-black text-4xl text-primary tracking-tighter shadow-sm transition-all">
                            </div>
                            <div
                                class="flex justify-between px-2 text-[9px] font-black uppercase tracking-widest text-primary/20">
                                <span>Min K1,000</span>
                                <span>Verified Max: K{{ number_format($maxEligible, 0) }}</span>
                            </div>
                        </div>

                        <!-- Duration Selector -->
                        <div class="space-y-6">
                            <label
                                class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30 px-2">Repayment
                                Period</label>
                            <div class="flex gap-4">
                                @foreach([3, 6, 12, 24] as $months)
                                    <label class="flex-1 cursor-pointer group">
                                        <input type="radio" name="duration_months" value="{{ $months }}" class="hidden peer"
                                            {{ $months == 6 ? 'checked' : '' }}>
                                        <div
                                            class="h-14 flex items-center justify-center rounded-2xl border-2 border-primary/5 bg-surface font-black text-xs uppercase tracking-widest text-primary/30 peer-checked:bg-primary peer-checked:border-primary peer-checked:text-white transition-all shadow-sm">
                                            {{ $months }} Months
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Dynamic Summary Card -->
                        <div
                            class="bg-primary p-8 rounded-[2.5rem] shadow-2xl shadow-primary/30 relative overflow-hidden group">
                            <div
                                class="absolute -right-10 -bottom-10 size-40 bg-accent/20 rounded-full blur-[80px] group-hover:scale-150 transition-transform duration-700">
                            </div>

                            <div class="relative space-y-8">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-[0.4em] text-white/40 mb-3">
                                            Estimated Monthly</p>
                                        <h4 class="font-display font-black text-5xl text-accent tracking-tighter"
                                            id="monthly-payment-display">K0.00</h4>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 mb-2">
                                            Fixed Rate</p>
                                        <span class="px-3 py-1 bg-white/10 rounded-lg text-white font-black text-lg"
                                            id="interest-rate-display">--%</span>
                                    </div>
                                </div>
                                <div
                                    class="pt-6 border-t border-white/10 flex justify-between items-center text-white/60">
                                    <div class="space-y-1">
                                        <p class="text-[9px] font-black uppercase tracking-widest text-white/30">
                                            Processing Fee</p>
                                        <span class="text-sm font-bold text-white/80">K0.00 (Waived)</span>
                                    </div>
                                    <div class="text-right space-y-1">
                                        <p class="text-[9px] font-black uppercase tracking-widest text-white/30">Total
                                            Repayable</p>
                                        <span class="text-lg font-black text-white"
                                            id="total-payable-display">K0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full h-20 bg-accent text-primary font-black text-xl rounded-3xl shadow-[0_24px_48px_-12px_rgba(16,185,129,0.35)] hover:shadow-[0_32px_64px_-16px_rgba(16,185,129,0.5)] hover:-translate-y-1 active:scale-95 transition-all flex items-center justify-center gap-3">
                            Confirm Application
                            <span class="material-symbols-outlined font-black">arrow_forward</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-12 px-6 text-center text-[10px] font-black uppercase tracking-[0.25em] text-primary/20">
        © 2026 PayNestSolutions | Encrypted Pipeline Alpha-7
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const amountInput = document.getElementById('amount-input');
            const productRadios = document.getElementsByName('loan_product_id');
            const durationRadios = document.getElementsByName('duration_months');

            const monthlyDisplay = document.getElementById('monthly-payment-display');
            const interestDisplay = document.getElementById('interest-rate-display');
            const totalDisplay = document.getElementById('total-payable-display');

            function updateCalculator() {
                const amount = amountInput.value;
                if (!amount || amount < 1000) return;

                let duration = 6;
                durationRadios.forEach(r => { if (r.checked) duration = r.value; });

                let productId = null;
                productRadios.forEach(r => { if (r.checked) productId = r.value; });

                fetch('{{ route("loans.calculate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        amount: amount,
                        duration: duration,
                        product_id: productId
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) return;

                        animateValue(monthlyDisplay, parseValue(monthlyDisplay.innerText), data.monthly_payment, 400, 'K');
                        animateValue(totalDisplay, parseValue(totalDisplay.innerText), data.total_payable, 400, 'K');
                        interestDisplay.innerText = data.interest_rate + '%';
                    });
            }

            function parseValue(text) {
                return Number(text.replace(/[^0-9.-]+/g, ""));
            }

            function animateValue(obj, start, end, duration, prefix = '') {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const val = Math.floor(progress * (end - start) + start);
                    obj.innerHTML = prefix + val.toLocaleString();
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            amountInput.addEventListener('input', updateCalculator);
            productRadios.forEach(r => r.addEventListener('change', updateCalculator));
            durationRadios.forEach(r => r.addEventListener('change', updateCalculator));

            updateCalculator();
        });
    </script>
</body>

</html>