@extends('layouts.app')

@section('title', 'Transmisi')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Data Tipe Transmisi</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transmission_type.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Tipe Transmisi</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.transmission_type.index') }}" class="btn btn-secondary"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
