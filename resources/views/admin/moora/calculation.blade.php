@extends('layouts.app')

@section('title', 'Hitung')

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
                        @foreach ($criteria as $k)
                            <th>{{ $k->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($criteria as $k)
                            <td>{{ number_format($weight[$k->id], 4) }}</td>
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
                        @foreach ($criteria as $k)
                            <th>{{ $k->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternative as $a)
                        <tr>
                            <td>{{ $a->name }}</td>
                            @foreach ($criteria as $k)
                                <td>{{ number_format($normalization[$a->id][$k->id], 4) }}</td>
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
            <h5 class="m-0 font-weight-bold text-primary">Hasil Percalculationan MOORA</h5>
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
                    @foreach ($valueMoora as $id => $value)
                        <tr>
                            <td>{{ $ranking++ }}</td>
                            <td>{{ $alternative->find($id)->name }}</td>
                            <td>{{ number_format($value, 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
