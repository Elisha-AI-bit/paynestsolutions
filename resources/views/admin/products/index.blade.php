<x-app-layout>
    <div class="p-8 lg:p-12 space-y-12 max-w-[1600px] mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">

        <!-- Header -->
        <header
            class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 pb-4 border-b border-primary/5"
            x-data="{ createModal: false }">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-accent">
                    <span class="material-symbols-outlined text-sm">inventory_2</span>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] leading-none">Capital Architect</p>
                </div>
                <h1 class="font-display text-5xl font-black tracking-tighter text-primary">Product Hub</h1>
                <p class="text-primary/40 text-lg font-medium">Design and calibrate credit products for various risk
                    apertures</p>
            </div>

            <button @click="$dispatch('open-create-modal')"
                class="group flex items-center gap-3 px-8 py-4 bg-primary text-white rounded-[2rem] font-extrabold shadow-2xl shadow-primary/30 hover:bg-accent hover:shadow-accent/40 hover:-translate-y-1 transition-all">
                <span
                    class="material-symbols-outlined text-accent group-hover:rotate-90 transition-transform">add_circle</span>
                New Product Architecture
            </button>
        </header>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" x-data="{ editProduct: null }">
            @foreach($products as $product)
                <div
                    class="group bg-white p-10 rounded-[4rem] border border-primary/5 shadow-sm hover:shadow-2xl transition-all relative overflow-hidden flex flex-col">
                    <div
                        class="absolute -right-16 -top-16 size-48 bg-primary/5 rounded-full blur-3xl group-hover:bg-accent/5 transition-colors">
                    </div>

                    <div class="flex justify-between items-start mb-10 relative">
                        <div
                            class="size-16 rounded-3xl bg-primary/5 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all shadow-sm">
                            <span class="material-symbols-outlined text-4xl">account_balance_wallet</span>
                        </div>
                        <button @click="editProduct = {{ $product->toJson() }}"
                            class="size-10 rounded-full bg-surface text-primary/30 hover:bg-primary hover:text-white transition-all flex items-center justify-center">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </button>
                    </div>

                    <div class="space-y-4 mb-10 relative">
                        <h3 class="font-display text-3xl font-black text-primary tracking-tighter">{{ $product->name }}</h3>
                        <p class="text-sm font-medium text-primary/40 leading-relaxed">
                            {{ $product->description ?? 'No architectural specifications provided.' }}</p>
                    </div>

                    <div class="mt-auto pt-10 border-t border-primary/5 grid grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <p class="text-[9px] font-black uppercase tracking-widest text-primary/20 leading-none">Max
                                Threshold</p>
                            <p class="font-display font-black text-2xl text-primary tracking-tighter">
                                K{{ number_format($product->max_amount / 1000) }}k</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[9px] font-black uppercase tracking-widest text-primary/20 leading-none">Interest
                                Vector</p>
                            <p class="font-display font-black text-2xl text-accent tracking-tighter">
                                {{ $product->interest_rate }}%</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Edit Modal -->
            <template x-if="editProduct">
                <div class="fixed inset-0 z-[100] flex items-center justify-center p-6">
                    <div class="absolute inset-0 bg-primary/60 backdrop-blur-xl" @click="editProduct = null"></div>
                    <div
                        class="relative w-full max-w-2xl bg-white rounded-[4rem] p-12 shadow-2xl animate-in zoom-in-95 duration-300">
                        <div class="flex justify-between items-center mb-10">
                            <h3 class="font-display text-3xl font-black text-primary tracking-tighter">Calibrate
                                Architecture</h3>
                            <button @click="editProduct = null"
                                class="size-10 rounded-full bg-surface text-primary/30 hover:bg-primary hover:text-white transition-all flex items-center justify-center">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <form :action="'{{ url('admin/products') }}/' + editProduct.id" method="POST" class="space-y-8">
                            @csrf
                            @method('PATCH')

                            <div class="space-y-4">
                                <label
                                    class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Identifier
                                    Name</label>
                                <input type="text" name="name" x-model="editProduct.name"
                                    class="w-full h-16 px-6 bg-surface border-2 border-primary/5 rounded-[1.5rem] font-bold text-primary focus:border-accent focus:ring-0 outline-none transition-all">
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Capital
                                        Limit (K)</label>
                                    <input type="number" name="max_amount" x-model="editProduct.max_amount"
                                        class="w-full h-16 px-6 bg-surface border-2 border-primary/5 rounded-[1.5rem] font-bold text-primary focus:border-accent focus:ring-0 outline-none transition-all">
                                </div>
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Yield
                                        Rate (%)</label>
                                    <input type="number" name="interest_rate" x-model="editProduct.interest_rate"
                                        step="0.01"
                                        class="w-full h-16 px-6 bg-surface border-2 border-primary/5 rounded-[1.5rem] font-bold text-accent focus:border-accent focus:ring-0 outline-none transition-all">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full h-20 bg-primary text-white font-black text-xl rounded-[2rem] shadow-2xl shadow-primary/30 hover:bg-accent transition-all">
                                Update Specifications
                            </button>
                        </form>
                    </div>
                </div>
            </template>
        </div>

        <!-- Create Modal -->
        <div x-data="{ open: false }" @open-create-modal.window="open = true">
            <template x-if="open">
                <div class="fixed inset-0 z-[100] flex items-center justify-center p-6">
                    <div class="absolute inset-0 bg-primary/60 backdrop-blur-xl" @click="open = false"></div>
                    <div
                        class="relative w-full max-w-2xl bg-white rounded-[4rem] p-12 shadow-2xl animate-in zoom-in-95 duration-300">
                        <div class="flex justify-between items-center mb-10">
                            <h3 class="font-display text-3xl font-black text-primary tracking-tighter">New Product Asset
                            </h3>
                            <button @click="open = false"
                                class="size-10 rounded-full bg-surface text-primary/30 hover:bg-primary hover:text-white transition-all flex items-center justify-center">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="space-y-4">
                                <label class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Product
                                    Designation</label>
                                <input type="text" name="name" required
                                    class="w-full h-16 px-6 bg-surface border-2 border-primary/5 rounded-[1.5rem] font-bold text-primary focus:border-accent focus:ring-0 outline-none transition-all"
                                    placeholder="e.g. Titanium Personal Credit">
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Capital
                                        Ceiling (K)</label>
                                    <input type="number" name="max_amount" required
                                        class="w-full h-16 px-6 bg-surface border-2 border-primary/5 rounded-[1.5rem] font-bold text-primary focus:border-accent focus:ring-0 outline-none transition-all"
                                        placeholder="50000">
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">APR
                                        Vector (%)</label>
                                    <input type="number" name="interest_rate" step="0.01" required
                                        class="w-full h-16 px-6 bg-surface border-2 border-primary/5 rounded-[1.5rem] font-bold text-accent focus:border-accent focus:ring-0 outline-none transition-all"
                                        placeholder="12.5">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label
                                    class="text-[10px] font-black uppercase tracking-[0.3em] text-primary/30">Architectural
                                    Narrative</label>
                                <textarea name="description"
                                    class="w-full h-32 p-6 bg-surface border-2 border-primary/5 rounded-[2rem] font-medium text-primary focus:border-accent focus:ring-0 outline-none transition-all resize-none"
                                    placeholder="Describe the product utility..."></textarea>
                            </div>

                            <button type="submit"
                                class="w-full h-20 bg-primary text-white font-black text-xl rounded-[2rem] shadow-2xl shadow-primary/30 hover:bg-accent transition-all">
                                Deploy Product
                            </button>
                        </form>
                    </div>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>