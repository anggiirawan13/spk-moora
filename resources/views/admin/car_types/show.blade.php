@extends('layouts.admin')
@section('content')

<h4>Detail Jenis Mobil</h4>

<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $carType->id }}</p>
        <p><strong>Nama:</strong> {{ $carType->name }}</p>
        <p><strong>Dibuat Pada:</strong> {{ $carType->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Diperbarui Pada:</strong> {{ $carType->updated_at->format('d-m-Y H:i') }}</p>

        <a href="{{ route('admin.car_types.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection
