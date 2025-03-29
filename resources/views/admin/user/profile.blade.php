@extends('layouts.app')

@section('title', 'User')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ubah Profil</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <img id="imagePreview" class="img-fluid mt-2" style="max-width: 300px; display: none;" />
                    <label for="image_name">Foto Profil</label>
                    <input type="file" name="image_name" id="image_name" class="form-control" accept="image/*" required
                        onchange="previewImage(event)" />
                </div>

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', auth()->user()->email) }}" required readonly>
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
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-secondary"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var imgElement = document.getElementById('imagePreview');
                imgElement.src = reader.result;
                imgElement.style.display = 'block'; // Tampilkan preview image
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
