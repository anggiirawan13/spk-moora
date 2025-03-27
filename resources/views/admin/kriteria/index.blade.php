@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
            <a href="{{route('kriteria.create')}}" class="btn btn-primary float-right"><i class="fas fa-fw fa-plus-circle"></i> Tambah Data</a>
        <h5 class="m-0 font-weight-bold text-primary">Kriteria</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Bobot</th>
                        <th>Atribut</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach ($kriteria as $key=>$item)

                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{$item->kode}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->bobot}}</td>
                        <td>{{$item->atribut}}</td>
                        <td>
                            <a href="{{route('kriteria.edit', $item->id)}}" class="btn btn-sm btn-primary mb-1 mt-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm mb-1 mt-1" 
                                onclick="confirmDelete('{{ route('kriteria.destroy', $item->id) }}', '{{ $item->nama }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
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
                            <p>Apakah Anda yakin ingin menghapus <strong id="criteriaName"></strong>?</p>
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
    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("imageModal");

        modal.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                var modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            }
        });

        var closeButton = document.querySelector("#imageModal .btn-close");
        closeButton.addEventListener("click", function() {
            var modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    });

    function confirmDelete(url, namaKriteria) {
        document.getElementById('criteriaName').innerText = namaKriteria;
        document.getElementById('deleteForm').action = url;

        // Tampilkan modal konfirmasi
        var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        confirmModal.show();
    }
</script>
@endsection
