<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostingBarangController extends Controller
{
    /**
     * Menampilkan form untuk menambah barang baru
     * Jika request adalah API, return JSON dengan form structure
     */
    public function create(Request $request)
    {
        // Return JSON untuk API request
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'categories' => $this->getCategories(),
                    'statuses' => Item::STATUS_LABELS,
                ],
            ]);
        }

        return view('barang.create', [
            'title' => 'Tambah Barang Baru',
            'categories' => $this->getCategories(),
            'statuses' => Item::STATUS_LABELS,
        ]);
    }

    /**
     * Menyimpan barang baru (POST)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:' . implode(',', [
                Item::STATUS_AVAILABLE,
                Item::STATUS_OUT_OF_STOCK,
                Item::STATUS_RESERVED,
            ]),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('items', $imageName, 'public');
            $validated['image_path'] = $imagePath;
        }

        // Set listed_at jika belum ada
        if (!isset($validated['listed_at'])) {
            $validated['listed_at'] = now();
        }

        $item = Item::create($validated);

        // Return JSON untuk API request, redirect untuk web request
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil ditambahkan!',
                'data' => $item,
            ], 201);
        }

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Mendapatkan daftar kategori yang tersedia
     */
    private function getCategories(): array
    {
        return [
            'Dapur',
            'Olahraga',
            'Buku & Alat Tulis',
            'Perabotan',
            'Elektronik',
            'Pakaian',
            'Mainan',
            'Lainnya',
        ];
    }
}

