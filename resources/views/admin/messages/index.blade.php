@extends('layouts.admin')

@section('content')
    <div class="row">
        <style>
            nav svg {
                height: 20px;
                ;
            }

            nav.hidden {
                display: block;
            }

            th {
                font-size: 0.875em;
            }
        </style>
        <div class="col-md">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Mobil</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Subjek</th>
                                <th>Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages as $message)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{ $message->name}}</td>
                                    <td>{{ $message->email }} </td>
                                    <td>{{ $message->nomor }}</td>
                                    <td>{{ $message->subjek }}</td>
                                    <td>{{ $message->pesan }}</td>
                                    <td>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-center">data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
