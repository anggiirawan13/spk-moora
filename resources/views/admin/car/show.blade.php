@extends('layouts.app')

@section('title', 'Mobil Bekas')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Detail Mobil: {{ $car->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $car->image_name ? asset('storage/car/' . $car->image_name) : asset('img/default-image.png') }}"
                            class="img-fluid rounded shadow" alt="{{ $car->name }}">
                    </div>
                    <div class="col-md-8">
                        <x-table_car :car="$car" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('car.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                @if (auth()->user()->is_admin == 1)
                    <a href="{{ route('car.edit', $car->id) }}" class="btn btn-primary">Edit</a>
                @endif
                <a href="{{ route('car.compare', $car->id) }}" class="btn btn-warning">Bandingkan dengan Mobil Lain</a>
            </div>
        </div>
    </div>

@endsection
