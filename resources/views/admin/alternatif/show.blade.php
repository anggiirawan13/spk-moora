@extends('layouts.admin')

@section('content')

<div class="col-lg-12 order-lg-1">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Detail Alternatif</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Alternatif</th>
                    <td>{{ $alternatif->nama }}</td>
                </tr>
            </table>

            <h6 class="mt-4 font-weight-bold">Nilai Kriteria</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Kode</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatif->values as $value)
                        <tr>
                            <td>{{ $value->criteria->nama }}</td>
                            <td>{{ $value->criteria->kode }}</td>
                            <td>{{ $value->nilai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                <a href="{{ route('alternatif.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                @if(auth()->user()->is_admin == 1)
                    <a href="{{ route('alternatif.edit', $alternatif->id) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
