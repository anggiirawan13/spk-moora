@props([
    'id' => null,
    'route' => '',
    'method' => 'POST',
    'imageRequired' => false,
    'passwordRequired' => false,
    'isReadOnly' => false,
    'withRole' => false,
    'withBack' => false,
    'routeBack' => '',
    'name' => '',
    'email' => '',
    'image' => '',
    'role' => 0,
    'deletePhotoProfile' => false,
])

<x-alert />

<form action="{{ $id ? route($route, $id) : route($route) }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method($method)

    <div class="form-group">
        <img id="imagePreview" class="img-fluid my-2"
            style="max-width: 300px; {{ $image ? 'display: block;' : 'display: none;' }}"
            src="{{ $image ? asset('storage/user/' . $image) : '' }}" />

        <label for="image_name">Foto Profil</label>
        <input type="file" name="image_name" id="image_name" class="form-control" accept="image/*"
            {{ $imageRequired ? 'required' : '' }} onchange="previewImage(event)" />

        @if ($image && $deletePhotoProfile)
            <button type="button" class="btn btn-danger btn-sm m-1"
                onclick="confirmDelete('{{ route('profile.delete_image', $id) }}')">
                <i class="fas fa-trash"></i> Hapus Foto Profil
            </button>
        @endif
    </div>
    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap"
            value="{{ old('name', $name) }}" required />
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Masukkan email"
            value="{{ old('email', $email) }}" required {{ $isReadOnly ? 'readOnly' : '' }} />
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            placeholder="Masukkan password" {{ $passwordRequired ? 'required' : '' }} />
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation"
            class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi password"
            {{ $passwordRequired ? 'required' : '' }} />
        @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @if ($withRole)
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" name="role" required>
                <option hidden>Pilih role</option>
                <option {{ $role == 1 ? 'selected' : '' }} value="1">Admin</option>
                <option {{ $role == 0 ? 'selected' : '' }} value="0">User</option>
            </select>
        </div>
    @endif
    <div class="form-group">
        @if ($withBack)
            <a href="{{ route($routeBack) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
        @endif
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
            Simpan</button>
    </div>
</form>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus foto profil?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div> <!-- End Modal -->

<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function() {
            var imgElement = document.getElementById('imagePreview');
            imgElement.src = reader.result;
            imgElement.style.display = 'block';
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    function confirmDelete(url) {
        document.getElementById('deleteForm').action = url;

        var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        confirmModal.show();
    }
</script>
