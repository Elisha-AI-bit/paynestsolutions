<x-app-layout>
    <div class="p-8 lg:p-12 space-y-12 max-w-[1600px] mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">

        <!-- Header -->
        <header
            class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 pb-4 border-b border-primary/5">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-accent">
                    <span class="material-symbols-outlined text-sm">history</span>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] leading-none">Capital Ledger</p>
                </div>
                <h1 class="font-display text-5xl font-black tracking-tighter text-primary">Capital Archive</h1>
                <p class="text-primary/40 text-lg font-medium">Historical audit of all credit deployments and settlement
                    statuses</p>
            </div>
        </header>

        <!-- Search & Filter (Visual Only for now) -->
        <div class="flex gap-4">
            <div class="flex-1 relative group">
                <span
                    class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-primary/20 group-focus-within:text-accent transition-colors">search</span>
                <input type="text" placeholder="Search by Applicant, ID, or Product..."
                    class="w-full h-16 pl-14 pr-8 bg-white border border-primary/5 rounded-2xl font-bold text-primary focus:border-accent focus:ring-4 focus:ring-accent/5 outline-none transition-all">
            </div>
            <button
                class="px-8 bg-white border border-primary/5 rounded-2xl font-bold text-primary/60 hover:bg-surface transition-all flex items-center gap-3">
                <span class="material-symbols-outlined text-lg">filter_list</span>
                Refine
            </button>
        </div>

        <!-- Loan Table -->
        <section class="bg-white rounded-[3.5rem] border border-primary/5 shadow-sm overflow-hidden flex flex-col">
            <header class="px-12 py-10 border-b border-primary/5 flex items-center justify-between">
                <div class="space-y-1">
                    <h2 class="font-display text-2xl font-black tracking-tight">Deployment History</h2>
                    <p class="text-xs font-bold text-primary/30 uppercase tracking-[0.2em]">Full Lifecycle Audit Trail
                    </p>
                </div>
            </header>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface/50">
                            <th
                                class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Reference</th>
                            <th
                                class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Applicant</th>
                            <th
                                class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Product Tier</th>
                            <th
                                class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Capital Sum</th>
                            <th
                                class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Status Path</th>
                            <th
                                class="px-12 py-6 text-right text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Deployed On</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary/5">
                        @foreach($loans as $loan)
                                            <tr class="group hover:bg-surface/40 transition-all">
                                                <td class="px-12 py-8">
                                                    <span
                                                        class="font-display font-black text-lg text-primary italic">#LN-{{ $loan->id }}</span>
                                                </td>
                                                <td class="px-12 py-8">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="size-8 rounded-lg bg-primary/5 flex items-center justify-center font-black text-primary text-[10px]">
                                                            {{ substr($loan->user->name, 0, 1) }}
                                                        </div>
                                                        <span class="font-bold text-primary text-sm">{{ $loan->user->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-12 py-8">
                                                    <span class="text-sm font-bold text-primary/60">{{ $loan->loanProduct->name }}</span>
                                                </td>
                                                <td class="px-12 py-8">
                                                    <span
                                                        class="font-display font-black text-xl text-primary tracking-tighter">K{{ number_format($loan->amount) }}</span>
                                                </td>
                                                <td class="px-12 py-8">
                                                    <span
                                                        class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest
                                                            {{ $loan->status == 'active' ? 'bg-accent/10 text-accent' :
                            ($loan->status == 'pending' ? 'bg-amber-100 text-amber-600' :
                                ($loan->status == 'rejected' ? 'bg-red-50 text-red-500' : 'bg-surface text-primary/40')) }}">
                                                        {{ $loan->status }}
                                                    </span>
                                                </td>
                                                <td class="px-12 py-8 text-right font-bold text-primary/30 text-sm italic">
                                                    {{ $loan->created_at->format('M d, Y') }}
                                                </td>
                                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-app-layout>