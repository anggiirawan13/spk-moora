@extends('layouts.navbar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('admin.car_brand.create')}}" class="btn btn-primary float-right">
            <i class="fas fa-fw fa-plus-circle"></i> Tambah Data
        </a>
        <h5 class="m-0 font-weight-bold text-primary">Daftar Merek Mobil</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($carBrands as $key => $carBrand)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $carBrand->name }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.car_brand.show', $carBrand->id) }}" class="btn btn-sm btn-info m-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                            
                                <a href="{{ route('admin.car_brand.edit', $carBrand->id) }}" class="btn btn-sm btn-primary m-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm m-1" 
                                    onclick="confirmDelete('{{ route('admin.car_brand.destroy', $carBrand->id) }}', '{{ $carBrand->name }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus <strong id="carBrandName"></strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(url, namaBrand) {
        document.getElementById('carBrandName').innerText = namaBrand;
        document.getElementById('deleteForm').action = url;

        // Tampilkan modal konfirmasi
        var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        confirmModal.show();
    }
</script>
@endsection
