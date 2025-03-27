@extends('layouts.admin')
@section('content')

<h4>Edit Jenis Mobil</h4>

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif

<form action="{{ route('admin.car_types.update', $carType->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama Jenis Mobil</label>
        <input type="text" class="form-control" name="name" value="{{ $carType->name }}" required>
    </div>

    <div class="form-group">
        <a href="{{ route('admin.car_types.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

@endsection
