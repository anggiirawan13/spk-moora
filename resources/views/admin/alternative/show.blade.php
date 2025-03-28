@extends('layouts.app')

@section('title', 'Alternatif')

@section('content')

    <div class="col-lg-12 order-lg-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Detail Alternatif</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Alternatif</th>
                        <td>{{ $alternative->name }}</td>
                    </tr>
                </table>

                <h6 class="mt-4 font-weight-bold">Nilai Kriteria</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternative->values as $value)
                            <tr>
                                <td>{{ $value->criteria->code }}</td>
                                <td>{{ $value->criteria->name }}</td>
                                <td>{{ $value->value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    <a href="{{ route('alternative.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                    @if (auth()->user()->is_admin == 1)
                        <a href="{{ route('alternative.edit', $alternative->id) }}" class="btn btn-primary">Edit</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
