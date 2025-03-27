@extends('layouts.navbar')
@section('content')

<h4>Detail Jenis Mobil</h4>

<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $carBrand->id }}</p>
        <p><strong>Nama:</strong> {{ $carBrand->name }}</p>
        <p><strong>Dibuat Pada:</strong> {{ $carBrand->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Diperbarui Pada:</strong> {{ $carBrand->updated_at->format('d-m-Y H:i') }}</p>

        <a href="{{ route('admin.car_brands.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection
