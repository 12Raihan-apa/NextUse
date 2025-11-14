<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $items = Item::query()
                ->latest('listed_at')
                ->latest()
                ->get();
        } catch (\Exception $e) {
            // Jika tabel belum ada, gunakan data dummy
            $items = collect([]);
        }

        if ($items->isEmpty()) {
            $items = collect([
                [
                    'title' => 'Rice Cooker Miyako 1.8L',
                    'category' => 'Dapur',
                    'status' => Item::STATUS_AVAILABLE,
                    'image_path' => null,
                    'listed_at' => now()->subDays(2),
                ],
                [
                    'title' => 'Sepeda Gunung MTB 26 inch',
                    'category' => 'Olahraga',
                    'status' => Item::STATUS_OUT_OF_STOCK,
                    'image_path' => null,
                    'listed_at' => now()->subWeek(),
                ],
                [
                    'title' => 'Koleksi Novel Harry Potter Lengkap',
                    'category' => 'Buku & Alat Tulis',
                    'status' => Item::STATUS_AVAILABLE,
                    'image_path' => null,
                    'listed_at' => now()->subDays(10),
                ],
                [
                    'title' => 'Meja Belajar Kayu Jati',
                    'category' => 'Perabotan',
                    'status' => Item::STATUS_RESERVED,
                    'image_path' => null,
                    'listed_at' => now()->subDays(20),
                ],
                [
                    'title' => 'Kamera Digital Canon EOS 700D',
                    'category' => 'Elektronik',
                    'status' => Item::STATUS_AVAILABLE,
                    'image_path' => null,
                    'listed_at' => now()->subDays(30),
                ],
            ])->map(fn ($attributes) => Item::make($attributes));
        }

        $categories = $items
            ->pluck('category')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->all();

        return view('inventory.index', [
            'title' => 'Inventori Saya',
            'items' => $items,
            'categories' => $categories,
            'statuses' => Item::STATUS_LABELS,
            'filters' => [
                'search' => $request->string('search')->toString(),
                'category' => $request->string('category')->toString(),
                'status' => $request->string('status')->toString(),
                'sort' => $request->string('sort', 'latest')->toString(),
            ],
        ]);
    }
}

