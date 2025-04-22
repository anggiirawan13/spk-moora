@extends('layouts.app')

@section('title', 'Sub Kriteria')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Daftar Sub Kriteria</h5>
        </div>

        <x-alert />

        @foreach ($criteria as $item)
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-table"></i> {{ $item->name }} ({{ $item->code }})
                    </h6>
                    <a href="{{ route('subcriteria.create', ['criteria_id' => $item->id]) }}"
                        class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Nama Sub Kriteria</th>
                                    <th class="text-center" style="width: 100px;">Nilai</th>
                                    <th class="text-center" style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->subCriteria as $sub)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $sub->name }}</td>
                                        <td class="text-center">{{ $sub->value }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('subcriteria.show', $sub['id']) }}"
                                                class="btn btn-sm btn-info m-1">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @auth
                                                @if (auth()->user()->is_admin == 1)
                                                    <a href="{{ route('subcriteria.edit', $sub['id']) }}"
                                                        class="btn btn-sm btn-primary m-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <button type="button" class="btn btn-danger btn-sm m-1"
                                                        onclick="confirmDelete('{{ route('subcriteria.destroy', $sub['id']) }}', '{{ $sub['name'] }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            @endauth
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($criteria->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus <strong id="dataName"></strong>?</p>
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
                        </div> <!-- End Modal -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<script>
    function confirmDelete(url, name) {
        document.getElementById('dataName').innerText = name;
        document.getElementById('deleteForm').action = url;

        var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        confirmModal.show();
    }
</script>
