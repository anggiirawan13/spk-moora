@extends('layouts.app')

@section('title', 'Hasil Perhitungan MOORA')

@section('content')

    <div class="container-fluid">

        <a href="{{ route('moora.download_pdf') }}" class="btn btn-success mb-3">
            <i class="fas fa-download"></i> Download Laporan PDF
        </a>

        {{-- Bobot Kriteria --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h5 class="m-0 font-weight-bold">Bobot Kriteria</h5>
            </div>
            <div class="card-body p-3">
                <table class="table table-bordered text-center">
                    <thead class="thead-light">
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

        {{-- Bobot Sub-Kriteria --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h5 class="m-0 font-weight-bold">Bobot Sub-Kriteria</h5>
            </div>
            <div class="card-body p-3">
                @foreach ($criteria as $k)
                    <h6 class="font-weight-bold mt-4">{{ $k->name }}</h6>
                    <table class="table table-sm table-bordered mb-3">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>Sub-Kriteria</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($k->subCriteria as $sub)
                                <tr class="text-center">
                                    <td>{{ $sub->name }}</td>
                                    <td>{{ $sub->value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>

        {{-- Normalisasi Matriks Keputusan --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h5 class="m-0 font-weight-bold">Normalisasi Matriks Keputusan</h5>
            </div>
            <div class="card-body p-3">
                <table class="table table-bordered text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($criteria as $k)
                                <th>{{ $k->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatives as $a)
                            <tr>
                                <td class="font-weight-bold">{{ $a->name }}</td>
                                @foreach ($criteria as $k)
                                    <td>{{ number_format($normalization[$a->id][$k->id] ?? 0, 4) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Hasil MOORA --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h5 class="m-0 font-weight-bold">Hasil Perhitungan MOORA</h5>
            </div>
            <div class="card-body p-3">
                <table class="table table-striped table-bordered text-center">
                    <thead class="thead-dark">
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
                                <td>{{ optional($alternatives->firstWhere('id', $id)->car)->name ?? '—' }}</td>
                                <td>{{ number_format($score, 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
