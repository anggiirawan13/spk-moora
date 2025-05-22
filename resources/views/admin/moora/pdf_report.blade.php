<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan MOORA</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            color: #222;
            margin: 20px;
        }

        h1 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .meta {
            font-size: 11px;
            margin-bottom: 30px;
        }

        .meta p {
            margin: 2px 0;
        }

        .section-title {
            background-color: #3f51b5;
            color: white;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0 20px;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #777;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #e0e0e0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        h4 {
            margin-top: 15px;
            font-size: 13px;
        }

        .footer {
            margin-top: 50px;
            font-size: 11px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

    <h1>Laporan Perhitungan MOORA</h1>

    <div class="meta">
        <p><strong>Nama Pengguna:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
        <p><strong>Waktu:</strong> {{ \Carbon\Carbon::now()->format('H:i:s') }}</p>
    </div>

    <div class="section-title">Bobot Kriteria</div>
    <table>
        <thead>
            <tr>
                @foreach ($criteria as $c)
                    <th>{{ $c->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($criteria as $c)
                    <td>{{ number_format($weight[$c->id], 4) }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <div class="section-title">Bobot Sub-Kriteria</div>
    @foreach ($criteria as $c)
        <h4>{{ $c->name }}</h4>
        <table>
            <thead>
                <tr>
                    <th>Sub-Kriteria</th>
                    <th>Nilai Mentah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($c->subCriteria as $sub)
                    <tr>
                        <td>{{ $sub->name }}</td>
                        <td>{{ $sub->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="section-title">Normalisasi Matriks Keputusan</div>
    <table>
        <thead>
            <tr>
                <th>Nama Alternatif</th>
                @foreach ($criteria as $c)
                    <th>{{ $c->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatives as $a)
                <tr>
                    <td>{{ $a->car->name ?? '—' }}</td>
                    @foreach ($criteria as $c)
                        <td>{{ number_format($normalization[$a->id][$c->id] ?? 0, 4) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Hasil Akhir MOORA</div>
    <table>
        <thead>
            <tr>
                <th>Peringkat</th>
                <th>Nama Alternatif</th>
                <th>Skor MOORA</th>
            </tr>
        </thead>
        <tbody>
            @php $rank = 1; @endphp
            @foreach ($valueMoora as $id => $score)
                @php $alt = $alternatives->firstWhere('id', $id); @endphp
                <tr>
                    <td>{{ $rank++ }}</td>
                    <td>{{ $alt->car->name ?? '—' }}</td>
                    <td>{{ number_format($score, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh {{ auth()->user()->name }} pada {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}
    </div>

</body>
</html>
