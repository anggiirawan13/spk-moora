@extends('layouts.navbar')

@section('content')
    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Data Pengguna</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap"
                        value="{{ old('name') }}" required />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                        value="{{ old('email') }}" required />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password" required />
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi password" required />
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>                                
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" required>
                        <option hidden>Pilih role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
