<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan MOORA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Perhitungan MOORA</h1>

    <h2>Bobot Kriteria</h2>
    <table>
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
                    <td>{{ number_format($weight[$k->id], 2) }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <h2>Normalisasi Matriks Keputusan</h2>
    <table>
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

    <h2>Hasil Perhitungan MOORA</h2>
    <table>
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
</body>
</html>
