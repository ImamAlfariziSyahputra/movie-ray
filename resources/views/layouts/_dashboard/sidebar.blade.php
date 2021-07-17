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
                        <i class="fas fa-tachometer-alt"></i>
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
                        <i class="fas fa-star"></i>
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
                        <i class="fas fa-star"></i>
                    </div>
                    Genres
                </a>
                <a 
                    class="nav-link" 
                    href="#"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    Directors
                </a>
                <a 
                    class="nav-link" 
                    href="#"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    Cast
                </a>
                <a 
                    class="nav-link" 
                    href="#"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    Movies
                </a>
                <a 
                    class="nav-link" 
                    href="#"
                >
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    User
                </a>
                
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name }}
        </div>
    </nav>
</div>