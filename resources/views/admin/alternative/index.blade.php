@extends('layouts.navbar')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        @if(auth()->user()->is_admin == 1)
            <a href="{{route('alternative.create')}}" class="btn btn-primary float-right">
                <i class="fas fa-fw fa-plus-circle"></i> Tambah Data
            </a>
        @endif
        <h5 class="m-0 font-weight-bold text-primary">Daftar Alternatif</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        @foreach ($criteria as $item)
                            <th>{{ $item->name }}</th>
                        @endforeach
                        <th width="11%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse ($alternative as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            @foreach ($criteria as $k)
                                <td>{{ $item->values->where('criteria_id', $k->id)->first()->value ?? '-' }}</td>
                            @endforeach
                            <td class="d-flex gap-1">
                                <!-- Tombol View Detail bisa diakses oleh semua user -->
                                <a href="{{ route('alternative.show', $item->id) }}" class="btn btn-sm btn-info m-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                            
                                <!-- Tombol Edit & Hapus hanya untuk admin -->
                                @if(auth()->user()->is_admin == 1)
                                    <a href="{{ route('alternative.edit', $item->id) }}" class="btn btn-sm btn-primary m-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm m-1" 
                                        onclick="confirmDelete('{{ route('alternative.destroy', $item->id) }}', '{{ $item->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
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
