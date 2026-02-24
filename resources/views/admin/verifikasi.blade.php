@extends('admin.layout')

@section('title','Verifikasi Pengembalian')

@section('content')

<style>
.card-verif{
    background:#fff;
    border-radius:20px;
    padding:30px;
    box-shadow:0 16px 36px rgba(0,0,0,.08);
    max-width:720px;
    margin:auto;
}
.label{
    font-size:14px;
    color:#64748b;
}
.value{
    font-weight:700;
}
.denda-box{
    background:#fef2f2;
    border:1px dashed #ef4444;
    padding:16px;
    border-radius:14px;
    font-size:18px;
    font-weight:800;
    color:#b91c1c;
}
.qris-box{
    border:1px dashed #22c55e;
    padding:18px;
    border-radius:14px;
    text-align:center;
}
</style>

<div class="mb-4">
    <h3 class="fw-bold">🔍 Verifikasi Pengembalian Buku</h3>
    <p class="text-muted">Periksa kondisi buku & selesaikan pembayaran denda</p>
</div>

<div class="card-verif">

    <div class="row mb-3">
        <div class="col-4 label">Nama Member</div>
        <div class="col-8 value">{{ $pinjam->user->nama }}</div>
    </div>

    <div class="row mb-3">
        <div class="col-4 label">Judul Buku</div>
        <div class="col-8 value">{{ $pinjam->buku->judul }}</div>
    </div>

    <div class="row mb-4">
        <div class="col-4 label">Deadline</div>
        <div class="col-8 value">
            {{ \Carbon\Carbon::parse($pinjam->tgl_kembali)->format('d M Y') }}
        </div>
    </div>

    <form action="{{ route('admin.verifikasi.proses', $pinjam->id) }}" method="POST">
        @csrf

        {{-- KONDISI --}}
        <div class="mb-3">
            <label class="label mb-1">Kondisi Buku</label>
            <select name="kondisi" id="kondisi" class="form-select" required>
                <option value="">Pilih kondisi</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>
        </div>

        {{-- DENDA --}}
        <div class="mb-3 d-none" id="boxDenda">
            <div class="label mb-1">Total Denda</div>
            <div class="denda-box" id="nominalDenda">Rp 0</div>
        </div>

        {{-- METODE BAYAR --}}
        <div class="mb-3">
            <label class="label mb-1">Metode Pembayaran</label>
            <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                <option value="">Pilih metode</option>
                <option value="cash">Cash</option>
                <option value="qris">QRIS</option>
            </select>
        </div>

        {{-- QRIS --}}
        <div class="mb-4 d-none" id="qrisBox">
            <div class="qris-box">
                <p class="fw-bold mb-2">Scan QRIS untuk Pembayaran</p>
                <img src="{{ asset('qris/qris.jfif') }}" width="220">
                <p class="text-muted mt-2">
                    Setelah pembayaran, klik konfirmasi
                </p>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.pengembalian') }}" class="btn btn-light">
                Batal
            </a>
            <button class="btn btn-danger">
                <i class="fa fa-check"></i> Konfirmasi & Selesai
            </button>
        </div>

    </form>
</div>

<script>
const kondisi = document.getElementById('kondisi');
const boxDenda = document.getElementById('boxDenda');
const nominal = document.getElementById('nominalDenda');
const metode = document.getElementById('metode_bayar');
const qrisBox = document.getElementById('qrisBox');

kondisi.addEventListener('change', function(){
    if(this.value === 'rusak'){
        boxDenda.classList.remove('d-none');
        nominal.innerText = 'Rp 150.000';
    }else if(this.value === 'hilang'){
        boxDenda.classList.remove('d-none');
        nominal.innerText = 'Rp 300.000';
    }else{
        boxDenda.classList.add('d-none');
    }
});

metode.addEventListener('change', function(){
    if(this.value === 'qris'){
        qrisBox.classList.remove('d-none');
    }else{
        qrisBox.classList.add('d-none');
    }
});
</script>

@endsection
