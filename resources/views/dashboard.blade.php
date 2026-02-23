<x-app-layout>
    <div class="p-8 lg:p-12 space-y-12 max-w-[1600px] mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">
        
        <!-- Premium Dashboard Header -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 pb-4 border-b border-primary/5">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-accent">
                    <span class="material-symbols-outlined text-sm">auto_awesome</span>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] leading-none">Intelligence Hub</p>
                </div>
                <h1 class="font-display text-5xl font-black tracking-tighter text-primary">Portfolio</h1>
                <p class="text-primary/40 text-lg font-medium">Monitoring active capital and credit eligibility for <span class="text-primary font-extrabold">{{ Auth::user()->name }}</span></p>
            </div>
            
            <div class="flex gap-4">
                <button class="flex items-center gap-2 px-6 py-3 bg-white border border-primary/5 rounded-2xl font-bold text-sm text-primary/60 hover:bg-surface transition-all">
                    <span class="material-symbols-outlined text-lg">calendar_today</span>
                    Feb 2026
                </button>
                <button @click="document.getElementById('loan-calculator').scrollIntoView({behavior: 'smooth'})"
                        class="group flex items-center gap-3 px-8 py-3.5 bg-primary text-white rounded-[2rem] font-extrabold shadow-2xl shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                    <span class="material-symbols-outlined text-accent group-hover:rotate-90 transition-transform">add_circle</span>
                    New Request
                </button>
            </div>
        </header>

        <!-- Extreme Elite Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $activeLoan = $loans->where('status', 'active')->first() ?? $loans->where('status', 'pending')->first();
                $nextPayment = $activeLoan ? $activeLoan->repayments()->where('status', 'pending')->orderBy('due_date')->first() : null;
            @endphp

            <!-- Status Ring Widget -->
            <div class="group bg-white p-8 rounded-[3rem] border border-primary/5 shadow-sm hover:shadow-2xl transition-all relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 size-40 bg-accent/5 rounded-full blur-3xl group-hover:bg-accent/10 transition-colors"></div>
                <div class="relative flex justify-between items-start mb-8">
                    <div class="size-14 rounded-2xl bg-primary/5 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-3xl">verified</span>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black uppercase tracking-widest text-primary/30">Activity</p>
                        <span class="text-xs font-bold text-accent">Real-time</span>
                    </div>
                </div>
                <div class="space-y-1">
                    <h3 class="text-3xl font-display font-black text-primary">{{ $activeLoan ? ucfirst($activeLoan->status) : 'Standby' }}</h3>
                    <p class="text-sm font-bold text-primary/40 uppercase tracking-[0.1em]">{{ $activeLoan ? 'Loan #'.$activeLoan->id : 'No Active Capital' }}</p>
                </div>
                <div class="mt-6 pt-6 border-t border-primary/5 flex items-center gap-2">
                    <span class="flex h-2 w-2 rounded-full {{ $activeLoan && $activeLoan->status == 'active' ? 'bg-accent animate-pulse' : 'bg-primary/20' }}"></span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-primary/40">Network Secure</span>
                </div>
            </div>

            <!-- Trust Index Progress -->
            <div class="group bg-white p-8 rounded-[3rem] border border-primary/5 shadow-sm hover:shadow-2xl transition-all relative overflow-hidden">
                <div class="relative flex justify-between items-start mb-8">
                    <div class="size-14 rounded-2xl bg-accent/10 flex items-center justify-center text-accent group-hover:bg-accent group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-3xl">shield_with_heart</span>
                    </div>
                </div>
                <div class="space-y-1">
                    <h3 class="text-3xl font-display font-black text-primary">{{ Auth::user()->risk_score }}<span class="text-primary/20">/100</span></h3>
                    <p class="text-sm font-bold text-primary/40 uppercase tracking-[0.1em]">Trust Index</p>
                </div>
                <div class="mt-6 space-y-2">
                    <div class="w-full h-1.5 bg-surface rounded-full overflow-hidden">
                        <div class="h-full bg-accent transition-all duration-1000" style="width: {{ Auth::user()->risk_score }}%"></div>
                    </div>
                    <p class="text-[10px] font-black text-accent uppercase tracking-widest">Elite Reliability Rank</p>
                </div>
            </div>

            <!-- Available Liquidity -->
            <div class="group bg-primary p-8 rounded-[3rem] shadow-2xl shadow-primary/30 hover:-translate-y-1 transition-all relative overflow-hidden">
                <div class="absolute -right-10 -top-10 size-40 bg-accent/10 rounded-full blur-3xl"></div>
                <div class="relative flex justify-between items-start mb-8">
                    <div class="size-14 rounded-2xl bg-white/10 flex items-center justify-center text-accent">
                        <span class="material-symbols-outlined text-3xl">account_balance_wallet</span>
                    </div>
                </div>
                <div class="space-y-1 text-white">
                    <h3 class="text-3xl font-display font-black">K{{ number_format($maxEligible/1000, 1) }}k</h3>
                    <p class="text-sm font-bold text-white/40 uppercase tracking-[0.1em]">Verified Limit</p>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-[10px] font-black text-accent uppercase tracking-widest">Tier 2 Access</span>
                    <span class="material-symbols-outlined text-white/20">trending_up</span>
                </div>
            </div>

            <!-- Repayment Timeline -->
            <div class="group bg-white p-8 rounded-[3rem] border border-primary/5 shadow-sm hover:shadow-2xl transition-all relative overflow-hidden text-primary">
                <div class="relative flex justify-between items-start mb-8">
                    <div class="size-14 rounded-2xl bg-red-50 flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-3xl">event_upcoming</span>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black uppercase tracking-widest text-primary/30">Deadline</p>
                        <span class="text-xs font-bold text-red-500">Scheduled</span>
                    </div>
                </div>
                <div class="space-y-1">
                    <h3 class="text-3xl font-display font-black italic">{{ $nextPayment ? $nextPayment->due_date->format('M d') : 'None' }}</h3>
                    <p class="text-sm font-bold text-primary/40 uppercase tracking-[0.1em]">{{ $nextPayment ? 'Monthly Installment' : 'Next Cycle' }}</p>
                </div>
                <div class="mt-6 flex items-baseline gap-1">
                    <span class="text-xl font-black">{{ $nextPayment ? 'K'.number_format($activeLoan->monthly_payment, 0) : '--' }}</span>
                    <span class="text-[10px] uppercase font-bold text-primary/30 tracking-widest">Required</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-12">
            <!-- Active Capital Table -->
            <div class="xl:col-span-2 space-y-8">
                <section class="bg-white rounded-[3.5rem] border border-primary/5 shadow-sm overflow-hidden flex flex-col">
                    <header class="px-12 py-10 border-b border-primary/5 flex items-center justify-between">
                        <div class="space-y-1">
                            <h2 class="font-display text-2xl font-black tracking-tight">Active Capital Log</h2>
                            <p class="text-xs font-bold text-primary/30 uppercase tracking-[0.2em]">Transaction Audit & History</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex -space-x-3">
                                @for($i=1; $i<=3; $i++)
                                    <div class="size-10 rounded-full border-4 border-white bg-primary/5 flex items-center justify-center text-[10px] font-black text-primary/30">S{{$i}}</div>
                                @endfor
                            </div>
                        </div>
                    </header>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-surface/50">
                                    <th class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">Index ID</th>
                                    <th class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">Status Path</th>
                                    <th class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">Timestamp</th>
                                    <th class="px-12 py-6 text-right text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">Capital Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary/5">
                                @foreach($loans as $loan)
                                    <tr class="group hover:bg-surface/40 transition-all">
                                        <td class="px-12 py-8">
                                            <div class="flex items-center gap-4">
                                                <div class="size-3 bg-primary/10 rounded-full group-hover:scale-150 group-hover:bg-accent transition-all"></div>
                                                <span class="font-display font-black text-xl text-primary">#LN-{{ $loan->id }}</span>
                                            </div>
                                        </td>
                                        <td class="px-12 py-8">
                                            <span class="px-5 py-2 rounded-[1.5rem] text-[10px] font-black uppercase tracking-[0.2em] shadow-sm
                                                {{ $loan->status == 'active' ? 'bg-accent text-white shadow-accent/20' : ($loan->status == 'pending' ? 'bg-amber-400 text-white shadow-amber-200' : 'bg-red-400 text-white shadow-red-200') }}">
                                                {{ $loan->status }}
                                            </span>
                                        </td>
                                        <td class="px-12 py-8 text-sm font-bold text-primary/30 tracking-tighter">{{ $loan->created_at->format('M d, Y') }}</td>
                                        <td class="px-12 py-8 text-right font-display font-black text-2xl text-primary tracking-tighter">K{{ number_format($loan->amount, 0) }}</td>
                                    </tr>
                                @endforeach
                                @empty($loans)
                                    <tr>
                                        <td colspan="4" class="px-12 py-24 text-center opacity-30 select-none">
                                            <span class="material-symbols-outlined text-6xl mb-4">move_to_inbox</span>
                                            <p class="font-display font-black text-xl tracking-tight uppercase">No Capital Records</p>
                                        </td>
                                    </tr>
                                @endempty
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <!-- Extreme Smart Calculator -->
            <div class="xl:col-span-1" id="loan-calculator">
                <div class="sticky top-12 bg-white rounded-[4rem] border border-primary/5 shadow-[0_48px_80px_-16px_rgba(15,23,42,0.1)] p-12 space-y-12">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 text-accent font-black text-[10px] uppercase tracking-[0.3em]">
                            <span class="size-2 rounded-full bg-accent animate-pulse"></span>
                            Smart Eligibility Engine
                        </div>
                        <h2 class="font-display text-4xl font-black tracking-tighter text-primary">Quick Apply</h2>
                        <p class="text-primary/40 font-medium leading-relaxed">Simulate your capital request and receive instant eligibility feedback.</p>
                    </div>

                    <form id="calc-form" action="{{ route('loans.store') }}" method="POST" class="space-y-10">
                        @csrf
                        
                        <div class="space-y-6">
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Capital Path</label>
                            <div class="grid grid-cols-1 gap-3">
                                @foreach($products as $product)
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="loan_product_id" value="{{ $product->id }}" 
                                               class="hidden peer" {{ $loop->first ? 'checked' : '' }}
                                               data-max="{{ $product->max_amount }}">
                                        <div class="flex items-center justify-between px-6 py-5 rounded-3xl border-2 border-primary/5 bg-surface text-primary/40 group-hover:border-accent/20 peer-checked:bg-primary peer-checked:border-primary peer-checked:text-white transition-all shadow-sm">
                                            <span class="font-bold text-sm tracking-tight">{{ $product->name }}</span>
                                            <span class="text-xs font-black opacity-40 uppercase tracking-widest">K{{ number_format($product->max_amount/1000) }}k Max</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="flex justify-between items-end">
                                <label class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Amount Required</label>
                                <span class="font-display font-black text-3xl text-primary tracking-tighter" id="amount-display">K1,000</span>
                            </div>
                            <input type="range" name="amount" id="amount-range" min="1000" max="{{ $maxEligible }}" step="500" value="1000" 
                                   class="w-full h-2 bg-surface rounded-full appearance-none cursor-pointer accent-accent focus:ring-0">
                        </div>

                        <div class="space-y-6">
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Horizon (Months)</label>
                            <div class="flex gap-4">
                                @foreach([3, 6, 12] as $months)
                                    <label class="flex-1 cursor-pointer group">
                                        <input type="radio" name="duration_months" value="{{ $months }}" class="hidden peer" {{ $months == 6 ? 'checked' : '' }}>
                                        <div class="h-14 flex items-center justify-center rounded-[1.5rem] border-2 border-primary/5 bg-surface font-black text-sm text-primary/30 peer-checked:bg-accent peer-checked:border-accent peer-checked:text-white transition-all">
                                            {{ $months }}m
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Result Visual -->
                        <div class="bg-primary p-10 rounded-[3rem] shadow-2xl shadow-primary/40 relative overflow-hidden group">
                            <div class="absolute -right-10 -bottom-10 size-40 bg-accent/20 rounded-full blur-[80px] group-hover:scale-150 transition-transform duration-700"></div>
                            
                            <div class="relative space-y-6">
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-[0.4em] text-white/40 mb-2 leading-none">Monthly Obligation</p>
                                    <h4 class="font-display font-black text-5xl text-accent tracking-tighter" id="monthly-payment-display">K0.00</h4>
                                </div>
                                <div class="pt-6 border-t border-white/10 flex justify-between items-center">
                                    <div class="space-y-1">
                                        <p class="text-[9px] font-black uppercase tracking-widest text-white/30">Fixed Rate</p>
                                        <span class="text-white font-bold" id="interest-rate-display">--%</span>
                                    </div>
                                    <div class="text-right space-y-1">
                                        <p class="text-[9px] font-black uppercase tracking-widest text-white/30">Total Value</p>
                                        <span class="text-white font-bold" id="total-payable-display">K0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" 
                                class="w-full h-20 bg-accent text-primary font-black text-xl rounded-[2.5rem] shadow-[0_24px_48px_-12px_rgba(16,185,129,0.4)] hover:shadow-[0_32px_64px_-16px_rgba(16,185,129,0.5)] hover:-translate-y-1 active:scale-95 transition-all">
                            Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Interactive Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const amountRange = document.getElementById('amount-range');
            const amountDisplay = document.getElementById('amount-display');
            const productRadios = document.getElementsByName('loan_product_id');
            const durationRadios = document.getElementsByName('duration_months');

            const monthlyDisplay = document.getElementById('monthly-payment-display');
            const interestDisplay = document.getElementById('interest-rate-display');
            const totalDisplay = document.getElementById('total-payable-display');

            function updateCalculator() {
                const amount = amountRange.value;
                amountDisplay.innerText = 'K' + Number(amount).toLocaleString();

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
                return Number(text.replace(/[^0-9.-]+/g,""));
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

            amountRange.addEventListener('input', updateCalculator);
            productRadios.forEach(r => r.addEventListener('change', updateCalculator));
            durationRadios.forEach(r => r.addEventListener('change', updateCalculator));

            updateCalculator();
        });
    </script>
</x-app-layout>