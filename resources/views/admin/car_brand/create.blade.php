@extends('layouts.app')

@section('title', 'Merek Mobil')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Data Merek Mobil</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.car_brand.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Merek Mobil</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.car_brand.index') }}" class="btn btn-secondary"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
