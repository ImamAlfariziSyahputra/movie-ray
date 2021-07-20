<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
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
                <div class="sb-sidenav-menu-heading">User Permission</div>
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
                <a 
                    class="nav-link" 
                    href="#"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-user-tie"></i>
                    </div>
                    User
                </a>
                <div class="sb-sidenav-menu-heading">Setiing</div>
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