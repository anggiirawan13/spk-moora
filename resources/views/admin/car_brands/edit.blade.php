@extends('layouts.admin')
@section('content')

<h4>Edit Jenis Mobil</h4>

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif

<form action="{{ route('admin.car_brands.update', $carBrand->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama Jenis Mobil</label>
        <input type="text" class="form-control" name="name" value="{{ $carBrand->name }}" required>
    </div>

    <div class="form-group">
        <a href="{{ route('admin.car_brands.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

@endsection
