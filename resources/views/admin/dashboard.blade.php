<x-app-layout>
    <div class="p-8 lg:p-12 space-y-12 max-w-[1600px] mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">

        <!-- Admin Dashboard Header -->
        <header
            class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 pb-4 border-b border-primary/5">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-accent">
                    <span class="material-symbols-outlined text-sm">shield_person</span>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] leading-none">Administrative Command</p>
                </div>
                <h1 class="font-display text-5xl font-black tracking-tighter text-primary">Command Center</h1>
                <p class="text-primary/40 text-lg font-medium">Global oversight and credit lifecycle management</p>
            </div>

            <div class="flex gap-4">
                <div
                    class="flex items-center gap-2 px-6 py-3 bg-white border border-primary/5 rounded-2xl font-bold text-sm text-primary/60">
                    <span class="material-symbols-outlined text-lg text-accent">dns</span>
                    System Online
                </div>
            </div>
        </header>

        <!-- Admin Global Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Loans -->
            <div
                class="group bg-white p-8 rounded-[3rem] border border-primary/5 shadow-sm hover:shadow-2xl transition-all relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 size-40 bg-primary/5 rounded-full blur-3xl"></div>
                <div class="relative flex justify-between items-start mb-8">
                    <div
                        class="size-14 rounded-2xl bg-primary/5 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-3xl">analytics</span>
                    </div>
                </div>
                <div class="space-y-1">
                    <h3 class="text-3xl font-display font-black text-primary">{{ number_format($stats['total_loans']) }}
                    </h3>
                    <p class="text-sm font-bold text-primary/40 uppercase tracking-[0.1em]">Total Portfolio Volume</p>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div
                class="group bg-white p-8 rounded-[3rem] border border-primary/5 shadow-sm hover:shadow-2xl transition-all relative overflow-hidden">
                <div class="relative flex justify-between items-start mb-8">
                    <div
                        class="size-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-3xl">pending_actions</span>
                    </div>
                    @if($stats['pending_approval'] > 0)
                        <span class="flex h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                    @endif
                </div>
                <div class="space-y-1">
                    <h3 class="text-3xl font-display font-black text-primary">
                        {{ number_format($stats['pending_approval']) }}</h3>
                    <p class="text-sm font-bold text-primary/40 uppercase tracking-[0.1em]">Awaiting Verification</p>
                </div>
            </div>

            <!-- Total Disbursed -->
            <div
                class="group bg-primary p-8 rounded-[3rem] shadow-2xl shadow-primary/30 hover:-translate-y-1 transition-all relative overflow-hidden">
                <div class="absolute -right-10 -top-10 size-40 bg-accent/10 rounded-full blur-3xl"></div>
                <div class="relative flex justify-between items-start mb-8">
                    <div class="size-14 rounded-2xl bg-white/10 flex items-center justify-center text-accent">
                        <span class="material-symbols-outlined text-3xl">payments</span>
                    </div>
                </div>
                <div class="space-y-1 text-white">
                    <h3 class="text-3xl font-display font-black">
                        K{{ number_format($stats['total_disbursed'] / 1000, 1) }}k</h3>
                    <p class="text-sm font-bold text-white/40 uppercase tracking-[0.1em]">Capital Disbursed</p>
                </div>
            </div>

            <!-- Total Repayments -->
            <div
                class="group bg-white p-8 rounded-[3rem] border border-primary/5 shadow-sm hover:shadow-2xl transition-all relative overflow-hidden text-primary">
                <div class="relative flex justify-between items-start mb-8">
                    <div
                        class="size-14 rounded-2xl bg-accent/10 flex items-center justify-center text-accent group-hover:bg-accent group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-3xl">receipt_long</span>
                    </div>
                </div>
                <div class="space-y-1">
                    <h3 class="text-3xl font-display font-black text-primary">
                        K{{ number_format($stats['total_repayments'] / 1000, 1) }}k</h3>
                    <p class="text-sm font-bold text-primary/40 uppercase tracking-[0.1em]">Revenue Recovered</p>
                </div>
            </div>
        </div>

        <!-- Pending Loan Applications -->
        <div class="grid grid-cols-1 gap-12">
            <section class="bg-white rounded-[3.5rem] border border-primary/5 shadow-sm overflow-hidden flex flex-col">
                <header class="px-12 py-10 border-b border-primary/5 flex items-center justify-between">
                    <div class="space-y-1">
                        <h2 class="font-display text-2xl font-black tracking-tight">Queue Verification</h2>
                        <p class="text-xs font-bold text-primary/30 uppercase tracking-[0.2em]">Pending Capital Requests
                        </p>
                    </div>
                    <div
                        class="px-4 py-2 rounded-full bg-surface text-[10px] font-black uppercase tracking-tighter text-primary/40">
                        {{ $pendingLoans->count() }} Requests
                    </div>
                </header>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-surface/50">
                                <th
                                    class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                    Applicant</th>
                                <th
                                    class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                    Product</th>
                                <th
                                    class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                    Requested Capital</th>
                                <th
                                    class="px-12 py-6 text-right text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary/5">
                            @foreach($pendingLoans as $loan)
                                <tr class="group hover:bg-surface/40 transition-all">
                                    <td class="px-12 py-8">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="size-12 rounded-xl bg-primary/5 flex items-center justify-center font-display font-black text-primary text-sm group-hover:bg-accent group-hover:text-white transition-all">
                                                {{ substr($loan->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-bold text-primary">{{ $loan->user->name }}</span>
                                                <span
                                                    class="text-[10px] font-black text-primary/20 uppercase tracking-widest">Score:
                                                    {{ $loan->user->risk_score }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-12 py-8">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-primary">{{ $loan->loanProduct->name }}</span>
                                            <span
                                                class="text-[10px] font-black text-primary/30 uppercase tracking-widest">{{ $loan->duration_months }}
                                                Months</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-8">
                                        <div class="flex flex-col">
                                            <span
                                                class="font-display font-black text-xl text-primary tracking-tighter">K{{ number_format($loan->amount) }}</span>
                                            <span
                                                class="text-[10px] font-black text-accent uppercase tracking-widest">{{ $loan->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-8 text-right">
                                        <div class="flex justify-end gap-3">
                                            <form action="{{ route('admin.loans.approve', $loan) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="h-10 px-6 bg-accent text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:shadow-lg hover:shadow-accent/20 transition-all">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.loans.reject', $loan) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="h-10 px-6 bg-red-50 text-red-500 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if($pendingLoans->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-12 py-24 text-center opacity-30 select-none">
                                        <span
                                            class="material-symbols-outlined text-6xl mb-4 text-primary/10">fact_check</span>
                                        <p class="font-display font-black text-xl tracking-tight uppercase">Queue is Empty
                                        </p>
                                        <p class="text-xs font-bold uppercase tracking-widest">No pending applications found
                                        </p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>