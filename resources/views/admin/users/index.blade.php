<x-app-layout>
    <div class="p-8 lg:p-12 space-y-12 max-w-[1600px] mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">

        <!-- Header -->
        <header
            class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 pb-4 border-b border-primary/5">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-accent">
                    <span class="material-symbols-outlined text-sm">group</span>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] leading-none">Identity Management</p>
                </div>
                <h1 class="font-display text-5xl font-black tracking-tighter text-primary">User Inventory</h1>
                <p class="text-primary/40 text-lg font-medium">Monitoring and adjusting credit parameters for all active
                    members</p>
            </div>
        </header>

        <!-- User Table -->
        <section class="bg-white rounded-[3.5rem] border border-primary/5 shadow-sm overflow-hidden flex flex-col"
            x-data="{ selectedUser: null }">
            <header class="px-12 py-10 border-b border-primary/5 flex items-center justify-between">
                <div class="space-y-1">
                    <h2 class="font-display text-2xl font-black tracking-tight">Active Profiles</h2>
                    <p class="text-xs font-bold text-primary/30 uppercase tracking-[0.2em]">Verified Identity Records
                    </p>
                </div>
            </header>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface/50">
                            <th
                                class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Member</th>
                            <th
                                class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Financial Context</th>
                            <th
                                class="px-12 py-6 text-left text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Risk Index</th>
                            <th
                                class="px-12 py-6 text-right text-[10px] font-black uppercase tracking-[0.25em] text-primary/40">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary/5">
                        @foreach($users as $user)
                            <tr class="group hover:bg-surface/40 transition-all">
                                <td class="px-12 py-8">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="size-12 rounded-xl bg-primary/5 flex items-center justify-center font-display font-black text-primary text-sm group-hover:bg-primary group-hover:text-white transition-all">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-primary">{{ $user->name }}</span>
                                            <span class="text-xs text-primary/30">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-12 py-8">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-display font-black text-lg text-primary">K{{ number_format($user->monthly_income) }}</span>
                                        <span
                                            class="text-[10px] font-black text-primary/20 uppercase tracking-widest">Reported
                                            Monthly Income</span>
                                    </div>
                                </td>
                                <td class="px-12 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-32 h-1.5 bg-surface rounded-full overflow-hidden">
                                            <div class="h-full bg-accent transition-all duration-1000"
                                                style="width: {{ $user->risk_score }}%"></div>
                                        </div>
                                        <span class="font-black text-primary">{{ $user->risk_score }}%</span>
                                    </div>
                                </td>
                                <td class="px-12 py-8 text-right">
                                    <button @click="selectedUser = {{ $user->toJson() }}"
                                        class="size-10 rounded-xl bg-primary/5 flex items-center justify-center text-primary/40 hover:bg-primary hover:text-white transition-all">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Edit Modal (Slide-over style) -->
            <template x-if="selectedUser">
                <div class="fixed inset-0 z-[100] flex items-center justify-end">
                    <div class="absolute inset-0 bg-primary/40 backdrop-blur-md" @click="selectedUser = null"></div>
                    <div
                        class="relative w-full max-w-xl h-full bg-white shadow-2xl p-12 overflow-y-auto animate-in slide-in-from-right duration-500">
                        <div class="flex justify-between items-center mb-12">
                            <h3 class="font-display text-3xl font-black text-primary tracking-tighter">Profile
                                Configuration</h3>
                            <button @click="selectedUser = null"
                                class="size-12 rounded-full border border-primary/5 flex items-center justify-center text-primary/40 hover:bg-surface transition-all">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <form :action="'{{ url('admin/users') }}/' + selectedUser.id" method="POST" class="space-y-12">
                            @csrf
                            @method('PATCH')

                            <div class="flex items-center gap-6 p-8 bg-surface rounded-[2rem] border border-primary/5">
                                <div class="size-16 rounded-2xl bg-accent flex items-center justify-center font-display font-black text-primary text-2xl"
                                    x-text="selectedUser.name.substring(0,1)"></div>
                                <div class="flex flex-col">
                                    <span class="text-2xl font-black text-primary" x-text="selectedUser.name"></span>
                                    <span class="text-sm font-bold text-primary/40" x-text="selectedUser.email"></span>
                                </div>
                            </div>

                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Intelligence:
                                        Risk Score (%)</label>
                                    <div class="relative">
                                        <input type="number" name="risk_score" x-model="selectedUser.risk_score" min="0"
                                            max="100"
                                            class="w-full h-20 px-8 bg-surface border-2 border-primary/5 rounded-[1.5rem] font-display font-black text-2xl text-primary focus:border-accent focus:ring-0 transition-all outline-none">
                                        <div
                                            class="absolute right-8 top-1/2 -translate-y-1/2 font-black text-primary/10 text-3xl italic">
                                            INDEX</div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Economic:
                                        Monthly Income (K)</label>
                                    <div class="relative">
                                        <input type="number" name="monthly_income" x-model="selectedUser.monthly_income"
                                            step="0.01"
                                            class="w-full h-20 px-8 bg-surface border-2 border-primary/5 rounded-[1.5rem] font-display font-black text-2xl text-primary focus:border-accent focus:ring-0 transition-all outline-none">
                                        <div
                                            class="absolute right-8 top-1/2 -translate-y-1/2 font-black text-primary/10 text-3xl italic">
                                            CAPITAL</div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full h-20 bg-primary text-white font-black text-xl rounded-[2rem] shadow-2xl shadow-primary/30 hover:bg-accent hover:text-white hover:shadow-accent/40 hover:-translate-y-1 transition-all">
                                Update Trajectories
                            </button>
                        </form>
                    </div>
                </div>
            </template>
        </section>
    </div>
</x-app-layout>