@extends('layouts.app')

@section('title', 'Alternatif')

@section('content')

    <x-alert />

    <div class="col-lg-12 order-lg-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Ubah Data Alternatif</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('alternative.update', $alternative->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama Alternatif</label>
                        <input type="text" class="form-control" name="name" value="{{ $alternative->name }}" required>
                    </div>

                    {{-- Looping kriteria dan tampilkan dropdown sub-kriteria --}}
                    @foreach ($criteria as $k)
                        <div class="form-group">
                            <label for="criteria_{{ $k->id }}">{{ $k->name }} ({{ $k->code }})</label>
                            <select class="form-control" name="criteria[{{ $k->id }}]"
                                id="criteria_{{ $k->id }}" required>
                                <option disabled selected>-- Pilih Sub-Kriteria --</option>
                                @foreach ($k->subCriteria as $sub)
                                    <option value="{{ $sub->id }}"
                                        {{ ($selectedSubs[$k->id] ?? null) == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <x-button_back route="alternative.index" />
                        <x-button_save />
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
