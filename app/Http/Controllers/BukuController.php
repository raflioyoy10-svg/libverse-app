<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.buku.create', compact('kategori'));
    }

    public function index()
    {
        $kategori = Kategori::with('buku')->get();
        return view('admin.buku.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required',
            'penulis'     => 'required',
            'kategori_id' => 'required',
            'stok'        => 'required|numeric',
            'gambar'      => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar
        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $gambarName = time().'_'.$request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('gambar_buku'), $gambarName);
        }

        Buku::create([
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'kategori_id' => $request->kategori_id,
            'stok'        => $request->stok,
            'gambar'      => $gambarName,
            'is_active'   => 1, // default aktif
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'       => 'required',
            'penulis'     => 'required',
            'kategori_id' => 'required',
            'stok'        => 'required|numeric',
            'gambar'      => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $buku = Buku::findOrFail($id);

        // Update gambar
        if ($request->hasFile('gambar')) {
            if ($buku->gambar && file_exists(public_path('gambar_buku/'.$buku->gambar))) {
                unlink(public_path('gambar_buku/'.$buku->gambar));
            }

            $gambarName = time().'_'.$request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('gambar_buku'), $gambarName);
            $buku->gambar = $gambarName;
        }

        $buku->judul       = $request->judul;
        $buku->penulis     = $request->penulis;
        $buku->kategori_id = $request->kategori_id;
        $buku->stok        = $request->stok;
        $buku->save();

        return redirect()->back()->with('success', 'Buku berhasil diperbarui!');
    }

    public function detail($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('admin.buku.detail', compact('buku'));
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        // NONAKTIFKAN SAJA (soft logic)
        $buku->is_active = 0;
        $buku->save();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dinonaktifkan');
    }
}
