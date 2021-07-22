@extends('layouts.main')

@section('content')

<main class="row justify-content-center no-gutters p-2">
    <div class="detail col-md-8 px-4">
        <div class="jumbotron-img mb-4">
        </div>
        <div class="detail-info d-flex mb-4">
            <div class="col-md-3 p-0">
                <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="img-fluid">
            </div>
            <div class="col-md-9 d-flex flex-column">
                {{-- Title --}}
                <h2>{{ $movie->title }}</h2>
                {{-- Desc --}}
                <p>{{ $movie->desc }}</p>
                <div class="">
                    <span class="mr-2">{{ $movie->year }}</span>
                    <span class="mr-2">US</span>
                    <span class="mr-2">{{ $movie->duration }} minutes</span>
                </div>
                <div class="flex-flex-row">
                    <hr class="">
                </div>
                <div>
                    <span class="font-weight-bold">Director : </span>
                    {{ $movie->director->name }}
                </div>
                <div class="mb-2">
                    <span class="font-weight-bold">Rating : </span>
                    {{ $movie->imdb_rating }}
                </div>
                <div class="category d-flex flex-wrap">
                    @foreach ($movie->genre as $genre)
                        <a href="" class="btn btn-dark mr-2 mb-2">{{ $genre->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        
        <ul class="nav nav-tabs mb-3 d-flex justify-content-between no-gutters border-bottom-0" id="myTab" role="tablist">
            <li class="nav-item col-md-4" role="presentation">
                <a class="nav-link active" id="synopsis-tab" data-toggle="tab" href="#synopsis" role="tab" aria-controls="synopsis" aria-selected="true">Synopsis</a>
            </li>
            <li class="nav-item col-md-4" role="presentation">
                <a class="nav-link" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer" aria-selected="false">Trailer</a>
            </li>
            <li class="nav-item col-md-4" role="presentation">
                <a class="nav-link" id="cast-tab" data-toggle="tab" href="#cast" role="tab" aria-controls="cast" aria-selected="false">Cast</a>
            </li>
        </ul>
        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="synopsis" role="tabpanel" aria-labelledby="synopsis-tab">
                {!! $movie->synopsis !!}
            </div>
            <div class="tab-pane fade" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">
                {{ $movie->trailer }}
            </div>
            <div class="tab-pane fade" id="cast" role="tabpanel" aria-labelledby="cast-tab">
                <h4>Cast :</h4>
                <div class="d-flex justify-content-between flex-wrap">
                    @foreach ($movie->cast as $cast)
                    <div class="col-md-4 d-flex mb-3">
                        <div class="cast__img mr-2">
                            <img src="{{ $cast->image }}" alt="{{ $cast->name }}" class="img-fluid">
                        </div>
                        <div class="d-flex flex-column">
                            <p class="m-0 text-white">{{ $cast->name }}</p>
                            {{-- <p class="m-0">Captain America</p> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('pages._sideList', [
        compact('genres'),
        compact('years'),
    ])

</main>

@push('custCss')

<style>
.jumbotron-img {
background-image: url('{{ $movie->banner }}');
}
</style>

@endpush

@endsection