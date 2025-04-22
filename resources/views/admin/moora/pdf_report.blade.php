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
        }

        h1,
        h2,
        h3,
        h4 {
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .meta {
            font-size: 11px;
            margin-bottom: 20px;
        }

        .meta strong {
            display: inline-block;
            width: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #555;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #eaeaea;
        }

        .section-title {
            background-color: #f5f5f5;
            padding: 8px;
            font-weight: bold;
            border-left: 5px solid #007BFF;
            margin-top: 30px;
            font-size: 14px;
        }

        .footer {
            margin-top: 40px;
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

    <div class="section-title">Bobot Global Sub-Kriteria</div>
    @foreach ($criteria as $c)
        <h4>{{ $c->name }}</h4>
        <table>
            <thead>
                <tr>
                    <th>Sub-Kriteria</th>
                    <th>Nilai Mentah</th>
                    <th>Bobot Global</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($c->subCriteria as $sub)
                    <tr>
                        <td>{{ $sub->name }}</td>
                        <td>{{ $sub->value }}</td>
                        <td>{{ number_format($subCriteriaGlobalWeights[$sub->id] ?? 0, 5) }}</td>
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
                    <td>{{ $a->name }}</td>
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
            @php $ranking = 1; @endphp
            @foreach ($valueMoora as $id => $score)
                <tr>
                    <td>{{ $ranking++ }}</td>
                    <td>{{ $alternatives->find($id)->name }}</td>
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
