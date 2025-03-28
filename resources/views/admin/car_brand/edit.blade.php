@extends('layouts.navbar')
@section('content')

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ubah Data Merek Mobil</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.car_brand.update', $carBrand->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Merek Mobil</label>
                    <input type="text" class="form-control" name="name" value="{{ $carBrand->name }}" required>
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.car_brand.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
