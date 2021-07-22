@extends('layouts.main')

@section('content')

<main class="row justify-content-center no-gutters p-2">
    <div class="content col-md-8 px-2">
        <!-- movies -->
        <div class="movies mb-5">
            <div class="heading-latest">
                <span class="">Latest Movies</span>
                <hr class="bg-primary m-0 mb-2">
            </div>
            <div class="row no-gutters">
                @foreach ($movies as $movie)
                <a href="{{ route('pages.detailMovie', $movie->slug) }}" class="col-md-3 poster__container">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="img-fluid poster__image">
                    {{-- <p class="poster__title">Black Widow</p> --}}
                </a>
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
        <!-- tv series -->
        <div class="series">
            <div class="heading-latest">
                <span class="">Latest Series</span>
                <hr class="bg-primary m-0 mb-2">
            </div>
            <div class="row justify-content-center no-gutters">
                <div class="col-md-3 poster__container">
                    <img src="https://www.joblo.com/assets/images/joblo/posters/2021/06/jolt-poster_thumb.jpg" alt=""
                        class="img-fluid poster__image">
                </div>
                <div class="col-md-3 poster__container">
                    <img src="https://www.joblo.com/assets/images/joblo/posters/2021/06/sing-2-movie-poster-2_thumb.jpg"
                        alt="" class="img-fluid poster__image">
                </div>
                <div class="col-md-3 poster__container">
                    <img src="https://www.joblo.com/assets/images/joblo/posters/2021/06/rsz_paw_patrol_the_movie_poster_thumb.jpg"
                        alt="" class="img-fluid poster__image">
                </div>
                <div class="col-md-3 poster__container">
                    <img src="https://www.joblo.com/assets/images/joblo/posters/2021/05/black-widow-character-poster-2021-1_thumb.jpg"
                        alt="" class="img-fluid poster__image">
                </div>
                <div class="col-md-3 poster__container">
                    <img src="https://www.joblo.com/assets/images/joblo/posters/2021/07/fear-steet-1666_thumb.jpg"
                        alt="" class="img-fluid poster__image">
                </div>
                <div class="col-md-3 poster__container">
                    <img src="https://www.joblo.com/assets/images/joblo/posters/2021/06/rsz_fatherhood-poster_thumb.jpg"
                        alt="" class="img-fluid poster__image">
                </div>
                <div class="col-md-3 poster__container">
                    <img src="https://www.joblo.com/assets/images/joblo/posters/2021/05/stillwater-poster_thumb.jpg"
                        alt="" class="img-fluid poster__image">
                </div>
                <div class="col-md-3 poster__container">
                    <img src="https://www.joblo.com/assets/images/joblo/posters/2021/06/snake-eyes-character-poster-7_thumb.jpg"
                        alt="" class="img-fluid poster__image">
                </div>
            </div>
        </div>
    </div>
    @include('pages._sideList', [
        compact('genres'),
        compact('years'),
    ])

</main>

@endsection