@extends('admin.layout')

@section('content')

<div class="container py-4">

<h3>Pembayaran Denda</h3>

<div style="background:white;padding:20px;border-radius:12px;max-width:520px">

<p><b>Member :</b> {{ $pinjam->user->nama }}</p>
<p><b>Buku :</b> {{ $pinjam->buku->judul }}</p>

<p>
<b>Denda Telat :</b> 
Rp <span id="dendaTelat">{{ number_format($pinjam->total_denda,0,',','.') }}</span>
</p>

<form action="{{ route('admin.denda.proses',$pinjam->id) }}" method="POST">
@csrf

{{-- KONDISI --}}
<label>Kondisi Buku</label>
<select name="kondisi" id="kondisiBuku" required>
<option value="">-- pilih kondisi --</option>
<option value="baik">Baik</option>
<option value="rusak">Rusak (+80k)</option>
<option value="hilang">Hilang (+120k)</option>
</select>

<br><br>

{{-- TOTAL --}}
<p>
<b>Total Bayar :</b>
Rp <span id="totalBayar">{{ number_format($pinjam->total_denda,0,',','.') }}</span>
</p>

{{-- METODE --}}
<label>Metode Pembayaran</label>
<select name="metode_bayar" id="metodeBayar" required>
<option value="">-- pilih --</option>
<option value="cash">Cash</option>
<option value="qris">QRIS</option>
</select>

<br><br>

<div id="boxQris" style="display:none;text-align:center">
<p><b>Scan QRIS</b></p>
<img src="{{ asset('qris.jfif') }}" width="220">
</div>

<br>

<button type="submit" class="btn-action">
Bayar Sekarang
</button>

</form>

</div>

</div>

<script>

const kondisi = document.getElementById('kondisiBuku');
const total = document.getElementById('totalBayar');
const metode = document.getElementById('metodeBayar');
const boxQris = document.getElementById('boxQris');

let dendaTelat = {{ $pinjam->total_denda }};

kondisi.addEventListener('change', function(){

    let tambahan = 0;

    if(this.value === 'rusak'){
        tambahan = 80000;
    }else if(this.value === 'hilang'){
        tambahan = 120000;
    }

    let totalFinal = dendaTelat + tambahan;

    total.innerText = totalFinal.toLocaleString('id-ID');

});

metode.addEventListener('change', function(){

    if(this.value === 'qris'){
        boxQris.style.display = 'block';
    }else{
        boxQris.style.display = 'none';
    }

});

</script>

@endsection
