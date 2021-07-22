@extends('layouts.main')

@section('content')

<main class="row justify-content-center no-gutters p-2">
    <div class="content col-md-8 px-2">
        <!-- movies -->
        <div class="movies mb-5">
            <div class="heading-latest">
                <span class="">Genre : {{ $choosenGenre }}</span>
                <hr class="bg-primary m-0 mb-2">
            </div>
            <div class="row no-gutters">
                @foreach ($movies as $movie)
                <div class="col-md-3 poster__container">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="img-fluid poster__image">
                    {{-- <p class="poster__title">Black Widow</p> --}}
                </div>
                @endforeach
            </div>
            @if ($movies->hasPages())
            <div class="d-flex mt-2">
                <div class="mx-auto">
                    {{ $movies->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </div>
    @include('pages._sideList', [
        compact('genres'),
        compact('years'),
    ])


</main>

@endsection