@extends('layouts.navbar')

@section('content')
    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Data Mobil Bekas</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="license_plate">Nomor Polisi</label>
                    <input type="text" name="license_plate" class="form-control" placeholder="Masukkan nomor polisi"
                        value="{{ old('license_plate') }}" required />
                </div>
                <div class="form-group">
                    <label for="name">Nama Mobil</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama mobil"
                        value="{{ old('name') }}" wire:model="name" wire:keyup="generateSlug" required />
                </div>
                <div class="form-group">
                    <label for="slug">Slug Mobil</label>
                    <input type="text" name="slug" class="form-control" placeholder="Masukkan slug car (Otomotais atau Manual)"
                        value="{{ old('slug') }}" required />
                </div>
                <div class="form-group">
                    <label for="image_path">Foto Mobil</label>
                    <input type="file" name="image_path" class="form-control" wire:model="image_path" required />
                </div>
                <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" placeholder="Masukkan harga dalam rupiah"
                        value="{{ old('price') }}" required />
                </div>
                <div class="form-group">
                    <label for="manufacture_year">Tahun Produksi</label>
                    <input type="number" name="manufacture_year" class="form-control" placeholder="Masukkan tahun produksi"
                        value="{{ old('manufacture_year') }}" required />
                </div>
                <div class="form-group">
                    <label for="brand_id">Merek Mobil</label>
                    <select class="form-control" name="brand_id" id="brand_id" required>
                        <option hidden>Pilih merek mobil</option>
                        @foreach ($brands as $carBrand)
                            <option value="{{ $carBrand->id }}">{{ $carBrand->name }}</option>
                        @endforeach
                    </select>
                </div>                
                <div class="form-group">
                    <label for="mileage">Jarak Tempuh (km)</label>
                    <input type="number" name="mileage" class="form-control" placeholder="Masukkan jarak tempuh dalam km" min="0"
                        value="{{ old('mileage') }}" required />
                </div>
                <div class="form-group">
                    <label for="fuel_type_id">Bahan bakar</label>
                    <select class="form-control" name="fuel_type_id" id="fuel_type_id" required>
                        <option hidden>Pilih bahan bakar</option>
                        @foreach ($fuelTypes as $fuelType)
                            <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kapasitas_mesin">Kapasitas Mesin (cc)</label>
                    <input type="text" name="kapasitas_mesin" class="form-control" placeholder="Masukkan kapasitas mesin dalam cc"
                        value="{{ old('kapasitas_mesin') }}" required />
                </div>
                <div class="form-group">
                    <label for="car_type_id">Jenis Mobil</label>
                    <select class="form-control" name="car_type_id" id="car_type_id" required>
                        <option hidden>Pilih jenis mobil</option>
                        @foreach ($carTypes as $carType)
                            <option value="{{ $carType->id }}">{{ $carType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="seat_count">Jumlah Kursi</label>
                    <input type="text" name="seat_count" class="form-control" placeholder="Masukkan jumlah kursi"
                        value="{{ old('seat_count') }}" required />
                </div>
                <div class="form-group">
                    <label for="transmission_type_id">Transmisi</label>
                    <select class="form-control" name="transmission_type_id" id="transmission_type_id" required>
                        <option hidden>Pilih transmisi</option>
                        @foreach ($transmissionTypes as $transmission)
                            <option value="{{ $transmission->id }}">{{ $transmission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="color">Warna Mobil</label>
                    <input type="text" name="color" class="form-control" placeholder="Masukkan color car"
                        value="{{ old('color') }}" required />
                </div>
                <div class="form-group">
                    <label for="owner">Nama Pemilik</label>
                    <input type="text" name="owner" class="form-control" placeholder="Masukkan nama pemilik mobil"
                        value="{{ old('owner') }}" wire:model="owner" required />
                </div>
                <div class="form-group">
                    <label for="owner_address">Alamat Pemilik</label>
                    <textarea class="form-control" name="owner_address" placeholder="Masukkan alamat lengkap pemilik mobil" id="owner_address" value="{{ old('owner_address') }}" required></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Mobil</label>
                    <textarea class="form-control" name="description" placeholder="Masukkan deskripsi mobil" id="description" value="{{ old('description') }}" required></textarea>
                </div>
                <div class="form-group">
                    <label for="is_available">Ketersediaan</label>
                    <select class="form-control" name="is_available" id="is_available" required>
                        <option hidden>Pilih status ketersediaan</option>
                        <option value="0">Tidak Tersedia</option>
                        <option value="1">Tersedia</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="{{ route('car.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
