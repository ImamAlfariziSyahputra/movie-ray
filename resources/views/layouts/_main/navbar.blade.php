<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('pages.home') }}">Movie-Ray</a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('pages.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">TV Series</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Genres</a>
                </li>
            </ul>
        </div>
        <form action="{{ route('pages.searchMovies') }}" method="GET" class="col-md-12 col-lg-auto form-inline my-sm-2 my-lg-0">
            <div class="d-flex search align-items-center pl-3 pr-2">
                <input 
                    class="form-control search__input m-0 p-0" 
                    name="keyword"
                    value="{{ request()->get('keyword') }}"
                    placeholder="Search">
                <button class="" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</nav>