@extends('layouts.app')

@section('title', 'Transmisi')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ubah Data Tipe Transmisi</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transmission_type.update', $transmissionType->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Tipe Transmisi</label>
                    <input type="text" class="form-control" name="name" value="{{ $transmissionType->name }}" required>
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
