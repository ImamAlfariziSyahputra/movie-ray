<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

//* Rating
// Dashboard > Rating
Breadcrumbs::for('rating', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Rating', route('ratings.index'));
});

// Dashboard > Rating > Add
Breadcrumbs::for('addRating', function (BreadcrumbTrail $trail) {
    $trail->parent('rating');
    $trail->push('Add', route('ratings.create'));
});

// Dashboard > Rating > Edit > [name]
Breadcrumbs::for('editRating', function (BreadcrumbTrail $trail, $rating) {
    $trail->parent('rating');
    $trail->push('Edit', route('ratings.edit', $rating));
    $trail->push($rating->number, route('ratings.edit', $rating));
});

//* Genre
// Dashboard > Genre
Breadcrumbs::for('genre', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Genre', route('genres.index'));
});
// Dashboard > Genre > Add
Breadcrumbs::for('addGenre', function (BreadcrumbTrail $trail) {
    $trail->parent('genre');
    $trail->push('Add', route('genres.create'));
});
// Dashboard > Genre > Edit > [name]
Breadcrumbs::for('editGenre', function (BreadcrumbTrail $trail, $genre) {
    $trail->parent('genre');
    $trail->push('Edit', route('genres.edit', $genre));
    $trail->push($genre->name, route('genres.edit', $genre));
});

//* Directors
// Dashboard > Directors
Breadcrumbs::for('director', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Directors', route('directors.index'));
});
// Dashboard > Directors > Add
Breadcrumbs::for('addDirector', function (BreadcrumbTrail $trail) {
    $trail->parent('director');
    $trail->push('Add', route('directors.create'));
});
// Dashboard > Directors > Edit > [name]
Breadcrumbs::for('editDirector', function (BreadcrumbTrail $trail, $director) {
    $trail->parent('director');
    $trail->push('Edit', route('directors.edit', $director));
    $trail->push($director->name, route('directors.edit', $director));
});

//* Casts
// Dashboard > Casts
Breadcrumbs::for('cast', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Casts', route('casts.index'));
});
// Dashboard > Casts > Add
Breadcrumbs::for('addCast', function (BreadcrumbTrail $trail) {
    $trail->parent('cast');
    $trail->push('Add', route('casts.create'));
});
// Dashboard > Casts > Edit > [name]
Breadcrumbs::for('editCast', function (BreadcrumbTrail $trail, $cast) {
    $trail->parent('cast');
    $trail->push('Edit', route('casts.edit', $cast));
    $trail->push($cast->name, route('casts.edit', $cast));
});
// Dashboard > Casts > Detail > [name]
Breadcrumbs::for('detailCast', function (BreadcrumbTrail $trail, $cast) {
    $trail->parent('cast');
    $trail->push('Detail', route('casts.show', $cast));
    $trail->push($cast->name, route('casts.show', $cast));
});
