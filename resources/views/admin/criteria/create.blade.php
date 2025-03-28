@extends('layouts.navbar')
@section('content')

@if(count($errors)>0)
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
        <h5 class="m-0 font-weight-bold text-primary">Tambah Data Kriteria</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('criteria.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Kode</label>
            <input required type="text" class="form-control" name="kode">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input required type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Bobot</label>
            <input required type="text" class="form-control" name="weight">
        </div>
        <div class="form-group">
          <label for="atirbut">Atribut</label>
          <select required class="form-control" name="atribut" id="atribut">
              <option hidden>Pilih atribut</option>
              <option value="Cost">Cost</option>
              <option value="Benefit">Benefit</option>
          </select>
        </div>

        <div class="form-group">
          <a href="{{ route('criteria.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </div>
        </form>
    </div>
  </div>
</div>

@endsection
