@extends('layouts.admin')

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
                    <a href="{{route('mobil.create')}}" class="btn btn-primary float-right"><i class="fas fa-fw fa-plus-circle"></i> Tambah Data</a>
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Mobil Bekas</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nomor Polisi</th>
                                <th>Nama Mobil</th>
                                <th>Harga (Rp)</th>
                                <th>Tahun Produksi</th>
                                <th>Jarak Tempuh (km)</th>
                                <th>Bahan Bakar</th>
                                <th>Kapasitas Mesin (cc)</th>
                                <th>Jumlah Kursi</th>
                                <th>Transmisi</th>
                                <th>Warna</th>
                                <th>Status Ketersediaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mobils as $mobil)
                                <tr>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#imageModal" onclick="showImage('{{ $mobil->nama }}', '{{ $mobil->gambar ? asset('storage/car/'.$mobil->gambar) : asset('frontend/imgs/default-image.png') }}')">
                                            <img class="default-img" 
                                                src="{{ $mobil->gambar ? asset('storage/car/'.$mobil->gambar) : asset('frontend/imgs/default-image.png') }}" 
                                                alt="{{ $mobil->nama }}" width="60">
                                        </a>
                                    </td>
                                    <td>{{ $mobil->nopol }}</td>
                                    <td>{{ $mobil->nama }}</td>
                                    <td>Rp {{ number_format($mobil->harga, 0, ',', '.') }}</td>
                                    <td>{{ $mobil->tahun }}</td>
                                    <td>{{ number_format($mobil->kilometer, 0, ',', '.') }} Kilometer</td>
                                    <td>{{ $mobil->bahan_bakar }}</td>
                                    <td>{{ $mobil->kapasitas_mesin }} cc</td>
                                    <td>{{ $mobil->jml_kursi }}</td>
                                    <td>{{ $mobil->transmisi }}</td>
                                    <td>{{ $mobil->warna }}</td>
                                    <td>{{ $mobil->ketersediaan }}</td>
                                    <td>
                                        <a href="{{route('mobil.edit', $mobil->id)}}" class="btn btn-sm btn-primary mb-1 mt-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm mb-1 mt-1" 
                                            onclick="confirmDelete('{{ route('mobil.destroy', $mobil->id) }}', '{{ $mobil->nama }}')">
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
                    <!-- Modal Bootstrap -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel"></h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img id="modalImage" src="" class="img-fluid rounded shadow-lg" style="max-height: 80vh; transition: 0.3s;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus <strong id="mobilName"></strong>?</p>
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
    </div>
    <script>
        function showImage(namaMobil, src) {
            document.getElementById('imageModalLabel').innerText = namaMobil;
            document.getElementById('modalImage').src = src;
        }

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

        function confirmDelete(url, namaMobil) {
            document.getElementById('mobilName').innerText = namaMobil;
            document.getElementById('deleteForm').action = url;

            // Tampilkan modal konfirmasi
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            confirmModal.show();
        }
    </script>
@endsection
