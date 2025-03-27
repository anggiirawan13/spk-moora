@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('alternatif.create') }}" class="btn btn-primary float-right">
            <i class="fas fa-fw fa-plus-circle"></i> Tambah Data
        </a>
        <h5 class="m-0 font-weight-bold text-primary">Alternatif</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        @foreach ($kriteria as $item)
                            <th>{{ $item->nama }}</th>
                        @endforeach
                        <th width="11%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($alternatif as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama }}</td>
                            @foreach ($kriteria as $k)
                                <td>{{ $item->values->where('criteria_id', $k->id)->first()->nilai ?? '-' }}</td>
                            @endforeach
                            <td>
                                <a href="{{ route('alternatif.edit', $item->id) }}" class="btn btn-sm btn-primary mb-1 mt-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm mb-1 mt-1" 
                                    onclick="confirmDelete('{{ route('alternatif.destroy', $item->id) }}', '{{ $item->nama }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus <strong id="alternativeName"></strong>?</p>
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

<script>
    function confirmDelete(url, namaAlternatif) {
        document.getElementById('alternativeName').innerText = namaAlternatif;
        document.getElementById('deleteForm').action = url;

        var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        confirmModal.show();
    }
</script>

@endsection
