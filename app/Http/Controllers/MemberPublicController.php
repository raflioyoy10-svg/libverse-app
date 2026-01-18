<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class MemberPublicController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $buku = Buku::where('is_active', 1)
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('member.public', compact('buku', 'search'));
    }

    public function tentang()
    {
        return view('member.tentang');
    }
}
