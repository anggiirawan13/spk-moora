@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Data Mobil Bekas</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nopol">Nomor Polisi</label>
                    <input type="text" name="nopol" class="form-control" placeholder="Masukkan nomor polisi"
                        value="{{ old('nopol') }}" required />
                </div>
                <div class="form-group">
                    <label for="nama">Nama Mobil</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama mobil"
                        value="{{ old('nama') }}" wire:model="nama" wire:keyup="generateSlug" required />
                </div>
                <div class="form-group">
                    <label for="slug">Slug Mobil</label>
                    <input type="text" name="slug" class="form-control" placeholder="Masukkan slug mobil (Otomotais atau Manual)"
                        value="{{ old('slug') }}" required />
                </div>
                <div class="form-group">
                    <label for="gambar">Foto Mobil</label>
                    <input type="file" name="gambar" class="form-control" wire:model="gambar" required />
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan harga dalam rupiah"
                        value="{{ old('harga') }}" required />
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun Produksi</label>
                    <input type="number" name="tahun" class="form-control" placeholder="Masukkan tahun produksi"
                        value="{{ old('tahun') }}" required />
                </div>
                <div class="form-group">
                    <label for="merek_id">Merek Mobil</label>
                    <select class="form-control" name="merek_id" id="merek_id" required>
                        <option hidden>Pilih merek mobil</option>
                        @foreach ($mereks as $merek)
                            <option value="{{ $merek->id }}">{{ $merek->name }}</option>
                        @endforeach
                    </select>
                </div>                
                <div class="form-group">
                    <label for="kilometer">Jarak Tempuh (km)</label>
                    <input type="text" name="kilometer" class="form-control" placeholder="Masukkan jarak tempuh dalam km"
                        value="{{ old('kilometer') }}" required />
                </div>
                <div class="form-group">
                    <label for="bahan_bakar">Bahan Bakar</label>
                    <select class="form-control" name="bahan_bakar" id="bahan_bakar" required>
                        <option hidden>Pilih bahan bakar</option>
                        <option value="Bensin">Bensin</option>
                        <option value="Solar">Solar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kapasitas_mesin">Kapasitas Mesin (cc)</label>
                    <input type="text" name="kapasitas_mesin" class="form-control" placeholder="Masukkan kapasitas mesin dalam cc"
                        value="{{ old('kapasitas_mesin') }}" required />
                </div>
                <div class="form-group">
                    <label for="jenis_mobil_id">Jenis Mobil</label>
                    <select class="form-control" name="jenis_mobil_id" id="jenis_mobil_id" required>
                        <option hidden>Pilih jenis mobil</option>
                        @foreach ($jenis_mobils as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                        @endforeach
                    </select>
                </div>                
                <div class="form-group">
                    <label for="jml_kursi">Jumlah Kursi</label>
                    <input type="text" name="jml_kursi" class="form-control" placeholder="Masukkan jumlah kursi"
                        value="{{ old('jml_kursi') }}" required />
                </div>
                <div class="form-group">
                    <label for="transmisi">Transmisi</label>
                    <select class="form-control" name="transmisi" id="transmisi" required>
                        <option hidden>Pilih tipe transmisi</option>
                        <option value="Manual">Manual</option>
                        <option value="Matic">Matic</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="warna">Warna Mobil</label>
                    <input type="text" name="warna" class="form-control" placeholder="Masukkan warna mobil"
                        value="{{ old('warna') }}" required />
                </div>
                <div class="form-group">
                    <label for="pemilik">Nama Pemilik</label>
                    <input type="text" name="pemilik" class="form-control" placeholder="Masukkan nama pemilik mobil"
                        value="{{ old('pemilik') }}" wire:model="pemilik" required />
                </div>
                <div class="form-group">
                    <label for="alamat_pemilik">Alamat Pemilik</label>
                    <textarea class="form-control" name="alamat_pemilik" placeholder="Masukkan alamat lengkap pemilik" id="alamat_pemilik" value="{{ old('alamat_pemilik') }}" required></textarea>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Mobil</label>
                    <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi mobil" id="deskripsi" value="{{ old('deskripsi') }}" required></textarea>
                </div>
                <div class="form-group">
                    <label for="ketersediaan">Ketersediaan</label>
                    <select class="form-control" name="ketersediaan" id="ketersediaan" required>
                        <option hidden>Pilih status ketersediaan</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                        <option value="Tersedia">Tersedia</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="{{ route('mobil.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
