{{-- Step 1: Masukkan Data Alternatif --}}
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Step 1: Masukkan Data Alternatif</strong>
    </div>
    <div class="card-body">
        <p>Rumus kuadrat per kriteria: <code>∑(x<sub>ij</sub>)² = x<sub>1j</sub>² + x<sub>2j</sub>² + ... +
                x<sub>nj</sub>²</code></p>

        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criteria as $c)
                        <th>{{ $c->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatives as $a)
                    <tr>
                        <td>{{ optional($a->car)->name ?? ($a->name ?? '—') }}</td>
                        @foreach ($criteria as $c)
                            @php
                                $val =
                                    optional($a->values->firstWhere('criteria_id', $c->id)?->subCriteria)->value ?? 0;
                            @endphp
                            <td>{{ number_format($val, 5) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="font-weight-bold bg-light">
                <tr>
                    <td>∑(x<sub>ij</sub>)²</td>
                    @foreach ($criteria as $c)
                        @php
                            $sumSquare = $alternatives->sum(function ($a) use ($c) {
                                $v = optional($a->values->firstWhere('criteria_id', $c->id)?->subCriteria)->value ?? 0;
                                return pow($v, 2);
                            });
                        @endphp
                        <td>{{ number_format($sumSquare, 5) }}</td>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </div>
</div>

{{-- Step 2: Normalisasi Akar --}}
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Step 2: Perhitungan Akar Total untuk Normalisasi</strong>
    </div>
    <div class="card-body">
        <p>Rumus akar untuk normalisasi per kriteria:
            <br>
            <code>√(∑(x<sub>ij</sub>)²) = √(x<sub>1j</sub>² + x<sub>2j</sub>² + ... + x<sub>nj</sub>²)</code>
        </p>

        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    @foreach ($criteria as $c)
                        <th>{{ $c->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{-- Baris jumlah kuadrat --}}
                <tr>
                    @foreach ($criteria as $c)
                        @php
                            $sumSquares = $alternatives->sum(function ($a) use ($c) {
                                $val =
                                    optional($a->values->firstWhere('criteria_id', $c->id)?->subCriteria)->value ?? 0;
                                return pow($val, 2);
                            });
                        @endphp
                        <td>{{ number_format($sumSquares, 5) }}</td>
                    @endforeach
                </tr>

                {{-- Baris hasil akar --}}
                <tr class="font-weight-bold bg-light">
                    @foreach ($criteria as $c)
                        <td>
                            {{ number_format($normDivisor[$c->id], 5) }}
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- Step 3: Normalisasi Nilai Alternatif --}}
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Step 3: Normalisasi Nilai Alternatif</strong>
    </div>
    <div class="card-body">
        <p>Rumus normalisasi per elemen:<br>
            <code>r<sub>ij</sub> = x<sub>ij</sub> / √(∑x<sub>ij</sub>²)</code>
        </p>

        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criteria as $c)
                        <th>{{ $c->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatives as $a)
                    <tr>
                        <td>{{ optional($a->car)->name ?? ($a->name ?? '—') }}</td>
                        @foreach ($criteria as $c)
                            @php
                                $raw =
                                    optional($a->values->firstWhere('criteria_id', $c->id)?->subCriteria)->value ?? 0;
                                $norm = $raw / ($normDivisor[$c->id] ?: 1);
                            @endphp
                            <td>{{ number_format($norm, 5) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Step 4: Nilai Normalisasi x Bobot --}}
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Step 4: Nilai Normalisasi × Bobot Kriteria</strong>
    </div>
    <div class="card-body">
        <p>
            Rumus untuk menghitung nilai tertimbang tiap alternatif:<br>
            <code>y<sub>ij</sub> = r<sub>ij</sub> × w<sub>j</sub></code><br>
            Di mana:
        <ul>
            <li><code>r<sub>ij</sub></code>: nilai hasil normalisasi</li>
            <li><code>w<sub>j</sub></code>: bobot kriteria ke-j</li>
        </ul>
        </p>

        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criteria as $c)
                        <th>{{ $c->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatives as $a)
                    <tr>
                        <td>{{ optional($a->car)->name ?? ($a->name ?? '—') }}</td>
                        @foreach ($criteria as $c)
                            <td>{{ number_format($normalization[$a->id][$c->id] ?? 0, 5) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Step 5 & 6: Hitung MOORA dan Ranking --}}
<div class="card shadow mb-4">
    <div class="card-header bg-info text-white">
        <strong>Step 5-6: Perhitungan Nilai Akhir MOORA dan Peringkat</strong>
    </div>
    <div class="card-body">
        <p>
            Rumus nilai akhir MOORA:<br>
            <code>Yi = Σ(W<sub>j</sub> × r<sub>ij</sub>) (benefit) − Σ(W<sub>j</sub> × r<sub>ij</sub>) (cost)</code>
        </p>

        <table class="table table-striped table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>Peringkat</th>
                    <th>Alternatif</th>
                    <th>Total Benefit</th>
                    <th>Total Cost</th>
                    <th>Yi (Benefit - Cost)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($valueMoora as $id => $yi)
                    @php
                        $alt = $alternatives->firstWhere('id', $id);
                        $benefit = 0;
                        $cost = 0;

                        foreach ($criteria as $c) {
                            $value = $normalization[$id][$c->id] ?? 0;
                            if (strtolower($c->attribute_type) === 'benefit') {
                                $benefit += $value;
                            } else {
                                $cost += $value;
                            }
                        }
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($alt->car)->name ?? ($alt->name ?? '—') }}</td>
                        <td>{{ number_format($benefit, 5) }}</td>
                        <td>{{ number_format($cost, 5) }}</td>
                        <td class="font-weight-bold">{{ number_format($yi, 5) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
