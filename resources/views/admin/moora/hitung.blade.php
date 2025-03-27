@extends('layouts.navbar')
@section('content')

<!-- Card Bobot Kriteria -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Bobot Kriteria</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    @foreach ($kriteria as $k)
                        <th>{{ $k->nama }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($kriteria as $k)
                        <td>{{ number_format($bobot[$k->id], 4) }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Card Normalisasi Matriks Keputusan -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Normalisasi Matriks Keputusan</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama Alternatif</th>
                    @foreach ($kriteria as $k)
                        <th>{{ $k->nama }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatif as $a)
                <tr>
                    <td>{{ $a->nama }}</td>
                    @foreach ($kriteria as $k)
                        <td>{{ number_format($normalisasi[$a->id][$k->id], 4) }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Card Hasil MOORA -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Hasil Perhitungan MOORA</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Alternatif</th>
                    <th>Nilai MOORA</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ranking = 1;
                @endphp
                @foreach ($nilaiMoora as $id => $nilai)
                <tr>
                    <td>{{ $ranking++ }}</td>
                    <td>{{ $alternatif->find($id)->nama }}</td>
                    <td>{{ number_format($nilai, 4) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
