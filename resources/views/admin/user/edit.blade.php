@extends('layouts.app')

@section('title', 'User')

@section('content')

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ubah Data Pengguna</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control">
                        <option value="admin" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->is_admin == 0 ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
