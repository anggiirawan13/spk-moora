@extends('layouts.navbar')

@section('content')
<div class="card">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Ubah Profil</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required readonly>
            </div>

            <div class="form-group">
                <label for="password">Password Baru (Kosongkan jika tidak ingin diubah)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="form-group">
                <a href="{{ route('admin.dashboard.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
