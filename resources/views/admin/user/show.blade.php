@extends('layouts.app')

@section('title', 'Transmisi')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Detail Akun: {{ $user->name }}</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <img id="imagePreview" class="img-fluid mt-2" style="max-width: 300px; display: none;" />
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->name }}</p>
                        </td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td>{{ $user->is_admin == 1 ? 'Admin' : 'User' }}
                    </tr>

                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $user->created_at->format('d-m-Y H:i') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Diperbarui Pada</th>
                        <td>{{ $user->updated_at->format('d-m-Y H:i') }}</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
                @if (auth()->user()->is_admin == 1)
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var imgElement = document.getElementById('imagePreview');
            var existingImage =
                "{{ asset('storage/user/' . auth()->user()->image_name) }}"; // Sesuaikan path dengan storage

            if (existingImage && "{{ auth()->user()->image_name }}") {
                imgElement.src = existingImage;
                imgElement.style.display = 'block'; // Tampilkan gambar jika ada
            }
        });
    </script>

@endsection
