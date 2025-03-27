@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ubah Data Mobil Bekas</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mobil.update', $mobil->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="nopol">Nomor Polisi</label>
                    <input type="text" name="nopol" class="form-control" placeholder="Masukkan nomor polisi"
                        value="{{ old('nopol', $mobil->nopol) }}" />
                </div>
                <div class="form-group">
                    <label for="nama">Nama Mobil</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama mobil"
                        value="{{ old('nama', $mobil->nama) }}" wire:model="nama" wire:keyup="generateSlug" />
                </div>
                <div class="form-group">
                    <label for="slug">Slug Mobil</label>
                    <input type="text" name="slug" class="form-control" placeholder="Masukkan slug mobil (Otomotais atau Manual)"
                        value="{{ old('slug', $mobil->slug) }}" />
                </div>
                <div class="form-group">
                    <label for="gambar">Foto Mobil</label>
                    <img src="{{asset('storage/car/'.$mobil->gambar)}}" width="100" alt="" class="mb-2 ml-2">
                    <input type="file" name="gambar" class="form-control" wire:model="gambar" />
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan harga dalam rupiah"
                        value="{{ old('harga', $mobil->harga) }}" />
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun Produksi</label>
                    <input type="number" name="tahun" class="form-control" placeholder="Masukkan tahun produksi"
                        value="{{ old('tahun', $mobil->tahun) }}" />
                </div>
                <div class="form-group">
                    <label for="merek">Merek Mobil</label>
                    <input type="text" name="merek" class="form-control" placeholder="Masukkan merek mobil"
                        value="{{ old('merek', $mobil->merek) }}" />
                </div>
                <div class="form-group">
                    <label for="kilometer">Jarak Tempuh (km)</label>
                    <input type="text" name="kilometer" class="form-control" placeholder="Masukkan jarak tempuh dalam km"
                        value="{{ old('kilometer', $mobil->kilometer) }}" />
                </div>
                <div class="form-group">
                    <label for="bahan_bakar">Bahan Bakar</label>
                    <select class="form-control" name="bahan_bakar" id="bahan_bakar">
                        <option hidden>Pilih bahan bakar</option>
                        <option value="Bensin">Bensin</option>
                        <option value="Solar">Solar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kapasitas_mesin">Kapasitas Mesin (cc)</label>
                    <input type="text" name="kapasitas_mesin" class="form-control" placeholder="Masukkan kapasitas mesin dalam cc"
                        value="{{ old('kapasitas_mesin', $mobil->kapasitas_mesin) }}" />
                </div>
                <div class="form-group">
                    <label for="tipe_mobil">Jenis Mobil</label>
                    <select class="form-control" name="tipe_mobil" id="tipe_mobil">
                        <option hidden>Pilih jenis mobil</option>
                        <option value="MPV">MPV</option>
                        <option value="SUV">SUV</option>
                        <option value="Hatchback">Hatchback</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jml_kursi">Jumlah Kursi</label>
                    <input type="text" name="jml_kursi" class="form-control" placeholder="Masukkan jumlah kursi"
                        value="{{ old('jml_kursi', $mobil->jml_kursi) }}" />
                </div>
                <div class="form-group">
                    <label for="transmisi">Transmisi</label>
                    <select class="form-control" name="transmisi" id="transmisi">
                        <option hidden>Pilih tipe transmisi</option>
                        <option value="Manual">Manual</option>
                        <option value="Matic">Matic</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="warna">Warna Mobil</label>
                    <input type="text" name="warna" class="form-control" placeholder="Masukkan warna mobil"
                        value="{{ old('warna', $mobil->warna) }}" />
                </div>
                <div class="form-group">
                    <label for="pemilik">Nama Pemilik</label>
                    <textarea class="form-control" name="pemilik" placeholder="Masukkan nama pemilik mobil" id="pemilik">{{ old('pemilik', $mobil->pemilik) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="alamat_pemilik">Alamat Pemilik</label>
                    <textarea class="form-control" name="alamat_pemilik" placeholder="Masukkan alamat lengkap pemilik" id="alamat_pemilik">{{ old('alamat_pemilik', $mobil->alamat_pemilik) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Mobil</label>
                    <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi mobil" id="deskripsi">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="ketersediaan">Ketersediaan</label>
                    <select class="form-control" name="ketersediaan" id="ketersediaan">
                        <option hidden>Pilih status ketersediaan</option>
                        <option {{ strtolower($mobil->ketersediaan) == strtolower("Tidak Tersedia") ? "selected" : "" }} value="Tidak Tersedia">Tidak Tersedia</option>
                        <option {{ strtolower($mobil->ketersediaan) == strtolower("Tersedia") ? "selected" : "" }} value="Tersedia">Tersedia</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="{{ route('mobil.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
