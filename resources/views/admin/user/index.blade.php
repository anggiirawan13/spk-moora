@extends('layouts.navbar')

@section('content')
    <div class="row">
        <style>
            nav svg {
                height: 20px;
            }

            nav.hidden {
                display: block;
            }

            th {
                font-size: 0.875em;
            }
            
            .modal-content {
                transform: scale(0.8);
                transition: transform 0.3s ease-in-out;
            }

            .modal.show .modal-content {
                transform: scale(1);
            }
        </style>
        <div class="col-md">
            <div class="card">
                <div class="card-header py-3">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-fw fa-plus-circle"></i> Tambah User
                    </a>
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Tanggal Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->is_admin ? 'badge-danger' : 'badge-primary' }}">
                                            {{ $user->is_admin ? 'Admin' : 'User' }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="confirmDelete('{{ route('admin.user.destroy', $user->id) }}', '{{ $user->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus <strong id="userName"></strong>?</p>
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
    </div>

    <script>
        function confirmDelete(url, userName) {
            document.getElementById('userName').innerText = userName;
            document.getElementById('deleteForm').action = url;

            // Tampilkan modal konfirmasi
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            confirmModal.show();
        }
    </script>
@endsection
