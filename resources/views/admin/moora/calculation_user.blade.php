@extends('layouts.app')

@section('title', 'Hasil MOORA Anda')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            {{-- Tombol Filter di Kiri --}}
            <button class="btn btn-outline-info" data-toggle="modal" data-target="#filterModal">
                <i class="fas fa-filter"></i> Filter
            </button>

            {{-- Tombol PDF di Kanan --}}
            <a href="{{ route('moora.download_pdf_user') }}" class="btn btn-info">
                <i class="fas fa-download"></i> Download Laporan PDF
            </a>
        </div>

        @if ($originalAlternativeCount === 0)
            <div class="alert alert-warning">
                <strong>Data tidak ditemukan sesuai filter.</strong><br>
                Menampilkan alternatif yang mendekati kriteria Anda.
            </div>
        @endif

        {{-- Tabel Hasil Ringkas --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="font-weight-bold text-white">Hasil Rekomendasi MOORA</h4>
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
                                <td>{{ optional($alt->car)->name ?? ($alt->name ?? '—') }}</td>
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
                'valueMoora' => $valueMoora,
            ])
        </div>

    </div>

    <!-- Modal Filter Kriteria -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="GET" action="{{ route('calculation.user') }}">
                <input type="hidden" name="filtered" value="1">

                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="filterModalLabel">Filter Kriteria</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            @foreach ($criteria as $c)
                                <div class="col-md-6 mb-3">
                                    <label><strong>{{ $c->name }}</strong></label>
                                    <select class="form-control" name="criteria[{{ $c->id }}]">
                                        <option value="">-- Tidak Dibatasi --</option>
                                        @foreach ($c->subCriteria as $sub)
                                            <option value="{{ $sub->id }}"
                                                {{ request()->input("criteria.{$c->id}") == $sub->id ? 'selected' : '' }}>
                                                {{ $sub->name }} ({{ $sub->value }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Script: Tampilkan Modal Otomatis --}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                @if ($showModal)
                    $('#filterModal').modal('show');
                @endif
            });
        </script>
    @endpush

@endsection
