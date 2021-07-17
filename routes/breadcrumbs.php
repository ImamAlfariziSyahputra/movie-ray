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
