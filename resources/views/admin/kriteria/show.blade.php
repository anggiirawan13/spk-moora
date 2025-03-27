@extends('layouts.navbar')

@section('content')

<div class="col-lg-12 order-lg-1">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Detail Kriteria</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Kode</th>
                    <td>{{ $kriteria->kode }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $kriteria->nama }}</td>
                </tr>
                <tr>
                    <th>Bobot</th>
                    <td>{{ $kriteria->bobot }}</td>
                </tr>
                <tr>
                    <th>Atribut</th>
                    <td>{{ $kriteria->atribut }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('kriteria.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                @if(auth()->user()->is_admin == 1)
                    <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
