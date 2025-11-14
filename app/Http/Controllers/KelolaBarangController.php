<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KelolaBarangController extends Controller
{
    /**
     * Menampilkan form edit barang
     * Jika request adalah API, return JSON dengan data barang
     */
    public function edit(Request $request, Item $item)
    {
        // Return JSON untuk API request
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'item' => $item,
                    'categories' => $this->getCategories(),
                    'statuses' => Item::STATUS_LABELS,
                ],
            ]);
        }

        return view('barang.edit', [
            'title' => 'Edit Barang',
            'item' => $item,
            'categories' => $this->getCategories(),
            'statuses' => Item::STATUS_LABELS,
        ]);
    }

    /**
     * Mengupdate barang (PUT/PATCH)
     */
    public function update(Request $request, Item $item)
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

        // Handle image upload jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }

            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('items', $imageName, 'public');
            $validated['image_path'] = $imagePath;
        }

        $item->update($validated);

        // Return JSON untuk API request, redirect untuk web request
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil diupdate!',
                'data' => $item->fresh(),
            ]);
        }

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Menghapus barang (DELETE)
     */
    public function destroy(Request $request, Item $item)
    {
        // Hapus gambar jika ada
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        // Return JSON untuk API request, redirect untuk web request
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil dihapus!',
            ]);
        }

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Barang berhasil dihapus!');
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

