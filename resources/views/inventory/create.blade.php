<x-app-layout>
    <div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 400)" 
         x-show="loading" 
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-950 transition-opacity duration-300">
        <div class="relative w-16 h-16">
            <div class="absolute inset-0 border-4 border-blue-500/20 rounded-full"></div>
            <div class="absolute inset-0 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
        </div>
    </div>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-white tracking-tight">Tambah <span class="text-blue-500 text-shadow-neon">Produk</span></h2>
                    <p class="text-gray-400 mt-1 text-sm">Masukkan detail barang baru ke dalam sistem Eksa Framework.</p>
                </div>
                <a href="{{ route('products.index') }}" class="flex items-center space-x-2 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-300 hover:text-white px-4 py-2.5 rounded-xl transition-all active:scale-95">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    <span>Kembali</span>
                </a>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl p-8">
                <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama Produk</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                <i data-lucide="box" class="w-5 h-5"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full bg-slate-900/50 border border-white/10 rounded-xl pl-11 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-inner hover:bg-slate-900/80">
                        </div>
                        @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-300 mb-2">SKU (Kode Barang)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <i data-lucide="barcode" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required
                                    class="w-full bg-slate-900/50 border border-white/10 rounded-xl pl-11 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-inner hover:bg-slate-900/80 uppercase">
                            </div>
                            @error('sku') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <i data-lucide="tags" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="category" id="category" value="{{ old('category') }}" required placeholder="Contoh: Elektronik"
                                    class="w-full bg-slate-900/50 border border-white/10 rounded-xl pl-11 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-inner hover:bg-slate-900/80">
                            </div>
                            @error('category') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-300 mb-2">Jumlah Stok</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <i data-lucide="layers" class="w-5 h-5"></i>
                                </div>
                                <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required min="0"
                                    class="w-full bg-slate-900/50 border border-white/10 rounded-xl pl-11 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-inner hover:bg-slate-900/80">
                            </div>
                            @error('stock') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Harga (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <i data-lucide="dollar-sign" class="w-5 h-5"></i>
                                </div>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="0.01"
                                    class="w-full bg-slate-900/50 border border-white/10 rounded-xl pl-11 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-inner hover:bg-slate-900/80">
                            </div>
                            @error('price') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-xl font-semibold transition-all shadow-[0_0_15px_rgba(37,99,235,0.4)] hover:shadow-[0_0_25px_rgba(37,99,235,0.6)] active:scale-95">
                            <i data-lucide="save" class="w-5 h-5"></i>
                            <span>Simpan Produk</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>