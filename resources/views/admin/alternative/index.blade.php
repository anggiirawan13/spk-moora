@extends('layouts.app')

@section('title', 'Alternatif')

@section('content')

    <x-alert />

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @auth
                @if (auth()->user()->is_admin == 1)
                    <a href="{{ route('alternative.store') }}" class="btn btn-primary float-right">
                        <i class="fas fa-fw fa-plus-circle"></i> Tambah Data
                    </a>
                @endif
            @endauth
            <h5 class="m-0 font-weight-bold text-primary">Daftar Alternative</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            @foreach ($criterias as $criteria)
                                <th>{{ $criteria->name }}</th>
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alternatives as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                @foreach ($criterias as $criteria)
                                    <td>{{ $item[$criteria->name] }}</td>
                                @endforeach
                                <td class="d-flex gap-1">
                                    <a href="{{ route('alternative.show', $item['id']) }}" class="btn btn-sm btn-info m-1">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @auth
                                        @if (auth()->user()->is_admin == 1)
                                            <a href="{{ route('alternative.edit', $item['id']) }}"
                                                class="btn btn-sm btn-primary m-1">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger btn-sm m-1"
                                                onclick="confirmDelete('{{ route('alternative.destroy', $item['id']) }}', '{{ $item['name'] }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                    </td>
                            @endif
                        @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($item) + 2 }}" class="text-center">Data Kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

    <script>
        function confirmDelete(url, name) {
            document.getElementById('dataName').innerText = name;
            document.getElementById('deleteForm').action = url;

            var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            confirmModal.show();
        }
    </script>



@endsection
