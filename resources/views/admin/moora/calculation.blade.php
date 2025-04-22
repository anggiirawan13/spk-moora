@extends('layouts.app')

@section('title', 'Hitung')

@section('content')

    <a href="{{ route('moora.download_pdf') }}" class="btn btn-success mb-2">Download Laporan PDF</a>

    <!-- Card Bobot Kriteria -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Bobot Kriteria</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered" width="100%">
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
                            <td>{{ number_format($weight[$k->id], 3) }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Card Bobot Global Sub-Kriteria -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Bobot Global Sub-Kriteria</h5>
        </div>
        <div class="card-body">
            @foreach ($criteria as $k)
                <h6 class="font-weight-bold mt-3">{{ $k->name }}</h6>
                <table class="table table-bordered mb-3">
                    <thead>
                        <tr>
                            <th>Sub-Kriteria</th>
                            <th>Nilai (1–n)</th>
                            <th>Bobot Global</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($k->subCriteria as $sub)
                            <tr>
                                <td>{{ $sub->name }}</td>
                                <td>{{ $sub->value }}</td>
                                <td>{{ number_format($subCriteriaGlobalWeights[$sub->id] ?? 0, 5) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>

    <!-- Card Normalisasi Matriks Keputusan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Normalisasi Matriks Keputusan</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        @foreach ($criteria as $k)
                            <th>{{ $k->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatives as $a)
                        <tr>
                            <td>{{ $a->name }}</td>
                            @foreach ($criteria as $k)
                                <td>{{ number_format($normalization[$a->id][$k->id] ?? 0, 4) }}</td>
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
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai MOORA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($valueMoora as $id => $score)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $alternatives->find($id)->name }}</td>
                            <td>{{ number_format($score, 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
