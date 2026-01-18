@extends('admin.layout')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Buku</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm p-4">

        <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" class="form-control" name="judul" value="{{ $buku->judul }}">
            </div>

            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" class="form-control" name="penulis" value="{{ $buku->penulis }}">
            </div>

            <div class="mb-3">
                <label>Kategori Buku</label>
                <select class="form-control" name="kategori_id">
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id }}" {{ $buku->kategori_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" class="form-control" name="stok" value="{{ $buku->stok }}">
            </div>

            {{-- Tampilkan gambar lama --}}
            <div class="mb-3">
                <label>Gambar Buku (Opsional)</label><br>
                <img src="{{ asset('gambar_buku/' . $buku->gambar) }}" 
                     width="120" class="img-thumbnail mb-2">
                <input type="file" class="form-control" name="gambar">
            </div>


            <button type="submit" class="btn btn-primary w-100">Update Buku</button>

        </form>
    </div>
</div>
@endsection
