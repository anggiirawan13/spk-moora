@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <a href="{{ route('car.index') }}">&larr; Back</a>
        </div>

    </div>
@endsection
