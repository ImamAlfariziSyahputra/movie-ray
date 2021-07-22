<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                {{-- Dashboard --}}
                <a 
                    class="nav-link {{ setActive([
                        'dashboard'
                    ]) }}" 
                    href="{{ route('dashboard') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>
                {{-- Ratings --}}
                @can('ratings.index')
                <a 
                    class="nav-link {{ setActive([
                        'ratings.index', 'ratings.create', 'ratings.edit'
                    ]) }}" 
                    href="{{ route('ratings.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-star"></i>
                    </div>
                    Ratings
                </a>
                @endcan
                {{-- Years --}}
                @can('years.index')
                <a 
                    class="nav-link {{ setActive([
                        'years.index', 'years.create', 'years.edit', 'years.show'
                    ]) }}" 
                    href="{{ route('years.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                    </div>
                    Years
                </a>
                @endcan
                {{-- Genres --}}
                @can('genres.index')
                <a 
                    class="nav-link {{ setActive([
                        'genres.index', 'genres.create', 'genres.edit'
                    ]) }}" 
                    href="{{ route('genres.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-chess-king"></i>
                    </div>
                    Genres
                </a>
                @endcan
                {{-- Directors --}}
                @can('directors.index')
                <a 
                    class="nav-link {{ setActive([
                        'directors.index', 'directors.create', 'directors.edit',
                    ]) }}" 
                    href="{{ route('directors.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-chess-rook"></i>
                    </div>
                    Directors
                </a>
                @endcan
                {{-- Casts --}}
                @can('casts.index')
                <a 
                    class="nav-link {{ setActive([
                        'casts.index', 'casts.create', 'casts.edit', 'casts.show'
                    ]) }}" 
                    href="{{ route('casts.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-chess-pawn"></i>
                    </div>
                    Cast
                </a>
                @endcan
                {{-- Movies --}}
                @can('movies.index')
                <a 
                    class="nav-link {{ setActive([
                        'movies.index', 'movies.create', 'movies.edit', 'movies.show'
                    ]) }}" 
                    href="{{ route('movies.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-video"></i>
                    </div>
                    Movies
                </a>
                @endcan
                <div class="sb-sidenav-menu-heading">User Permission</div>
                {{-- User --}}
                @can('users.index')
                <a 
                    class="nav-link {{ setActive([
                        'users.index', 'users.create', 'users.edit'
                    ]) }}" 
                    href="{{ route('users.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-user-tie"></i>
                    </div>
                    User
                </a>
                @endcan
                {{-- Role --}}
                @can('roles.index')
                <a 
                    class="nav-link {{ setActive([
                        'roles.index', 'roles.create', 'roles.edit'
                    ]) }}" 
                    href="{{ route('roles.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-user-tie"></i>
                    </div>
                    Role
                </a>
                @endcan
                <div class="sb-sidenav-menu-heading">Setting</div>
                <a 
                    class="nav-link {{ setActive([
                        'fileManager.index'
                    ]) }}" 
                    href="{{ route('fileManager.index') }}"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-folder-open"></i>
                    </div>
                    File Manager
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name }}
        </div>
    </nav>
</div>