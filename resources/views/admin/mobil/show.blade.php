@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Detail Mobil: {{ $mobil->nama }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $mobil->gambar ? asset('storage/car/'.$mobil->gambar) : asset('frontend/imgs/default-image.png') }}" 
                            class="img-fluid rounded shadow" alt="{{ $mobil->nama }}">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr><th>Nomor Polisi</th><td>{{ $mobil->nopol }}</td></tr>
                            <tr><th>Nama Mobil</th><td>{{ $mobil->nama }}</td></tr>
                            <tr><th>Harga</th><td>Rp {{ number_format($mobil->harga, 0, ',', '.') }}</td></tr>
                            <tr><th>Tahun Produksi</th><td>{{ $mobil->tahun }}</td></tr>
                            <tr><th>Jarak Tempuh</th><td>{{ number_format($mobil->kilometer, 0, ',', '.') }} km</td></tr>
                            <tr><th>Bahan Bakar</th><td>{{ $mobil->bahan_bakar }}</td></tr>
                            <tr><th>Kapasitas Mesin</th><td>{{ $mobil->kapasitas_mesin }} cc</td></tr>
                            <tr><th>Jumlah Kursi</th><td>{{ $mobil->jml_kursi }}</td></tr>
                            <tr><th>Transmisi</th><td>{{ $mobil->transmisi }}</td></tr>
                            <tr><th>Warna</th><td>{{ $mobil->warna }}</td></tr>
                            <tr><th>Merek Mobil</th><td>{{ $mobil->carType?->name ?? 'N/A' }}</td></tr>
                            <tr><th>Jenis Mobil</th><td>{{ $mobil->carBrand?->name ?? 'N/A' }}</td></tr>
                            <tr><th>Nama Pemilik</th><td>{{ $mobil->pemilik }}</td></tr>
                            <tr><th>Alamat Pemilik</th><td>{{ $mobil->alamat_pemilik }}</td></tr>
                            <tr><th>Deskripsi Mobil</th><td>{{ $mobil->deskripsi }}</td></tr>
                            <tr><th>Status Ketersediaan</th><td>{{ $mobil->ketersediaan }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('mobil.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                @if(auth()->user()->is_admin == 1)
                    <a href="{{ route('mobil.edit', $mobil->id) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>
    </div>
@endsection
