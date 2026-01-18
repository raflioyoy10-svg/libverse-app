<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::with(['buku', 'user'])
            ->whereHas('buku', function ($query) {
                $query->where('is_active', 1); // ✅ hanya buku aktif
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.ulasan.index', compact('ulasan'));
    }
}
