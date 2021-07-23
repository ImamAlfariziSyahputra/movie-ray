<div class="side col-md-3">
    <div class="genres mb-4">
        <div class="genres__heading d-flex justify-content-between">
            <span class="">Genres</span>
            <i class="fa fa-fw fa-caret-down"></i>
        </div>
        <div class="genres__items d-flex flex-column">
            @foreach ($genres as $genre)
            <div class="genres__item">
                {{-- Genre Item --}}
                <a 
                    href="{{ route('pages.genreMovies', $genre->slug) }}" 
                    class="d-flex justify-content-between"
                >
                    <div class="d-flex align-items-center">
                        <i class="fa fa-caret-square-right mr-2"></i>
                        <span>{{ $genre->name }}</span>
                    </div>
                    <div>
                        {{-- ({{ $genre->movie }}) --}}
                    </div>
                </a>

                <hr class="mt-1 mb-2 d-block">
            </div>
            @endforeach
        </div>
    </div>
    <div class="genres">
        <div class="genres__heading">
            <span class="">Release Year</span>
        </div>
        <div class="genres__items d-flex flex-column">
            @foreach ($years as $year)
            <div class="genres__item">
                <a href="{{ route('pages.yearMovies', $year->name) }}" class="d-flex align-items-center">
                    <i class="fa fa-caret-square-right mr-2"></i>
                    <span>{{ $year->name }}</span>
                </a>
                <hr class="mt-1 mb-2 d-block">
            </div>
            @endforeach
        </div>
    </div>
</div>