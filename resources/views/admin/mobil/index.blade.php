@extends('layouts.admin')

@section('content')
    <div class="row">
        <style>
            nav svg {
                height: 20px;
            }

            nav.hidden {
                display: block;
            }

            th {
                font-size: 0.875em;
            }
        </style>
        <div class="col-md">
            <div class="card">
                <div class="card-header py-3">
                    <a href="{{route('mobil.create')}}" class="btn btn-primary float-right"><i class="fas fa-fw fa-plus-circle"></i> Tambah Data</a>
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Mobil</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nopol</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Tahun</th>
                                <th>Kilometer</th>
                                <th>BahanBakar</th>
                                <th>Mesin</th>
                                <th>Seater</th>
                                <th>Transmisi</th>
                                <th>Ketersediaan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mobils as $mobil)
                                <tr>
                                    <td>
                                        <img class="default-img" 
                                                src="{{ $mobil->gambar && Storage::exists('public/'.$mobil->gambar) ? url('/storage/'.$mobil->gambar) : asset('frontend/imgs/default-image.png') }}" 
                                                alt="{{ $mobil->nama }}" width="60">
                                    </td>
                                    <td>{{ $mobil->nopol }}</td>
                                    <td>{{ $mobil->nama }}</td>
                                    <td>{{ $mobil->harga }} juta</td>
                                    <td>{{ $mobil->tahun }}</td>
                                    <td>{{ $mobil->kilometer }}km</td>
                                    <td>{{ $mobil->bahan_bakar }}</td>
                                    <td>{{ $mobil->kapasitas_mesin }}cc</td>
                                    <td>{{ $mobil->jml_kursi }}</td>
                                    <td>{{ $mobil->transmisi }}</td>
                                    <td>{{ $mobil->ketersediaan }}</td>
                                    <td>
                                        <a href="{{route('mobil.edit', $mobil->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                        <form onclick="return confirm('anda yakin data dihapus?');"
                                        class="d-inline" action="{{route('mobil.destroy',$mobil->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-center">Data Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
