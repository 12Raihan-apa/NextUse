@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white flex flex-col">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded bg-emerald-500 text-white font-bold text-lg shadow-sm">
                        N
                    </div>
                    <span class="text-lg font-semibold text-gray-800">NextUse</span>
                </div>
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-700">
                    <a href="#" class="hover:text-gray-900 transition-colors">Browse</a>
                    <a href="#" class="hover:text-gray-900 transition-colors">Post Item</a>
                    <a href="#" class="hover:text-gray-900 transition-colors">Messages</a>
                    <a href="#" class="font-semibold text-gray-900">Profile</a>
                </nav>
                <div class="flex items-center gap-4">
                    <button type="button" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                        <span class="sr-only">Notifikasi</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0 1 18 14.158V11a6.002 6.002 0 0 0-4-5.659V5a2 2 0 1 0-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 1 1-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-red-500"></span>
                    </button>
                    <button type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-emerald-500 text-white font-semibold shadow-sm">
                        U
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
            <!-- Title Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Inventori Saya</h1>
                        <p class="text-sm text-gray-500">Kelola semua barang yang Anda posting.</p>
                    </div>
                    <button
                        type="button"
                        class="inline-flex items-center justify-center gap-2 bg-emerald-500 px-5 py-2.5 rounded-lg text-sm font-semibold text-white hover:bg-emerald-600 transition-colors shadow-sm hover:shadow-md"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Posting Barang Baru
                    </button>
                </div>

                <!-- Search and Filters -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m21 21-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                            </svg>
                        </span>
                        <input
                            type="search"
                            name="search"
                            placeholder="Cari barang..."
                            value="{{ $filters['search'] }}"
                            class="w-full border border-gray-300 rounded-lg bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 placeholder:text-gray-400 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-20 transition-all"
                        />
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <select class="border border-gray-300 rounded-lg bg-white px-4 py-2.5 text-sm text-gray-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-20 transition-all cursor-pointer">
                            <option>Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ $filters['category'] === $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        <select class="border border-gray-300 rounded-lg bg-white px-4 py-2.5 text-sm text-gray-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-20 transition-all cursor-pointer">
                            <option>Semua Status</option>
                            @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" {{ $filters['status'] === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <select class="border border-gray-300 rounded-lg bg-white px-4 py-2.5 text-sm text-gray-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-20 transition-all cursor-pointer">
                            <option value="latest" {{ $filters['sort'] === 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ $filters['sort'] === 'oldest' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
                </div>
            </div>

            @php
                $statusStyles = [
                    \App\Models\Item::STATUS_AVAILABLE => 'bg-emerald-100 text-emerald-700',
                    \App\Models\Item::STATUS_RESERVED => 'bg-yellow-100 text-yellow-700',
                    \App\Models\Item::STATUS_OUT_OF_STOCK => 'bg-red-100 text-red-700',
                ];
            @endphp

            <!-- Table Section -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($items as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex h-14 w-14 items-center justify-center rounded-lg bg-emerald-50 border border-emerald-100">
                                            @if ($item->image_path)
                                                <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}" class="h-14 w-14 rounded-lg object-cover"/>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-700">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusKey = $item->status ?? \App\Models\Item::STATUS_AVAILABLE;
                                            $badgeClass = $statusStyles[$statusKey] ?? 'bg-gray-100 text-gray-700';
                                            $statusLabel = \App\Models\Item::STATUS_LABELS[$statusKey] ?? ucfirst(str_replace('_', ' ', $statusKey));
                                        @endphp
                                        <span class="inline-flex items-center rounded-full px-3 py-1.5 text-xs font-semibold {{ $badgeClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors">
                                            <span class="sr-only">Menu</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                            <p class="text-sm font-medium text-gray-500 mb-1">Belum ada barang yang diposting</p>
                                            <p class="text-xs text-gray-400">Mulai dengan menambahkan barang pertama Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-6">
            <p class="text-center text-xs text-gray-500">
                © {{ now()->year }} NextUse. Platform berbagi dan barter barang gratis.
            </p>
        </div>
    </footer>
</div>
@endsection
