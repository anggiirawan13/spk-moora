@extends('layouts.navbar')
@section('content')

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif
@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session('success') }}
    </div>
@endif

<div class="col-lg-12 order-lg-1">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Data Alternatif</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('alternative.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Alternatif</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                {{-- Looping Kriteria --}}
                @foreach($criteria as $k)
                <div class="form-group">
                    <label>{{ $k->name }} ({{ $k->code }})</label>
                    <input type="number" class="form-control" name="value_{{ $k->id }}" required>
                </div>
                @endforeach

                <div class="form-group">
                    <a href="{{ route('alternative.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
