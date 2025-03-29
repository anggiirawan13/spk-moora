@extends('layouts.navbar')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Detail Mobil: {{ $car->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $car->image_path ? asset('storage/car/'.$car->image_path) : asset('img/default-image.png') }}" 
                            class="img-fluid rounded shadow" alt="{{ $car->name }}">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr><th>Nomor Polisi</th><td>{{ $car->license_plate }}</td></tr>
                            <tr><th>Nama Mobil</th><td>{{ $car->name }}</td></tr>
                            <tr><th>Harga</th><td>Rp {{ number_format($car->price, 0, ',', '.') }}</td></tr>
                            <tr><th>Tahun Produksi</th><td>{{ $car->manufacture_year }}</td></tr>
                            <tr><th>Jarak Tempuh</th><td>{{ number_format($car->mileage, 0, ',', '.') }} km</td></tr>
                            <tr><th>Bahan Bakar</th><td>{{ $car->fuelType?->name ?? 'N/A' }}</td></tr>
                            <tr><th>Kapasitas Mesin</th><td>{{ $car->engine_capacity }} cc</td></tr>
                            <tr><th>Jumlah Kursi</th><td>{{ $car->seat_count }}</td></tr>
                            <tr><th>Transmisi</th><td>{{ $car->transmissionType?->name ?? 'N/A' }}</td></tr>
                            <tr><th>Warna</th><td>{{ $car->color }}</td></tr>
                            <tr><th>Merek Mobil</th><td>{{ $car->carType?->name ?? 'N/A' }}</td></tr>
                            <tr><th>Jenis Mobil</th><td>{{ $car->carBrand?->name ?? 'N/A' }}</td></tr>
                            <tr><th>Nama Pemilik</th><td>{{ $car->owner_name }}</td></tr>
                            <tr><th>Alamat Pemilik</th><td>{{ $car->owner_address }}</td></tr>
                            <tr><th>Deskripsi Mobil</th><td>{{ $car->description }}</td></tr>
                            <tr><th>Status Ketersediaan</th><td>{{ $car->is_available == 0 ? 'Tidak Tersedia' : 'Tersedia' }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('car.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                @if(auth()->user()->is_admin == 1)
                    <a href="{{ route('car.edit', $car->id) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>
    </div>
@endsection
