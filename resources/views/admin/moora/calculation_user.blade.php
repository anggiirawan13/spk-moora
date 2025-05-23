@extends('layouts.app')

@section('title', 'Hasil MOORA Anda')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4 font-weight-bold text-primary">Hasil Rekomendasi MOORA</h4>

    {{-- Tabel Hasil Ringkas --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <strong>Ringkasan Hasil</strong>
        </div>
        <div class="card-body">
            <p>Dibawah ini adalah hasil akhir perhitungan menggunakan metode MOORA.</p>
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Peringkat</th>
                        <th>Alternatif</th>
                        <th>Nilai Yi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($valueMoora as $id => $yi)
                        @php $alt = $alternatives->firstWhere('id', $id); @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($alt->car)->name ?? $alt->name ?? '—' }}</td>
                            <td class="font-weight-bold">{{ number_format($yi, 5) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Detail --}}
    <div class="text-right mb-4">
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#detailSection">
            <i class="fas fa-info-circle"></i> Lihat Detail Perhitungan
        </button>
    </div>

    {{-- Detail Collapse --}}
    <div id="detailSection" class="collapse">
        @include('admin.moora.calculation_user_detail', [
            'criteria' => $criteria,
            'alternatives' => $alternatives,
            'normalization' => $normalization,
            'normDivisor' => $normDivisor,
            'valueMoora' => $valueMoora
        ])
    </div>

</div>
@endsection
