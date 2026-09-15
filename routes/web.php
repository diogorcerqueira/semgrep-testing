<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// VULNERABLE: matches custom rule `laravel-missing-has-access-scope`
// No ->hasAccess() scope in the chain — returns rows across tenants/users.
Route::get('/users', function () {
    return User::query()->get();
});

// VULNERABLE: same rule, static shortcut form
Route::get('/users/all', function () {
    return User::all();
});

// VULNERABLE: same rule, filtered query still missing hasAccess()
Route::get('/users/search', function () {
    $status = request('status');

    return User::where('status', $status)->get();
});

// VULNERABLE: same rule, single record lookup
Route::get('/users/{id}', function ($id) {
    return User::find($id);
});

// SAFE: hasAccess() present in the chain — negative test case
Route::get('/users-safe', function () {
    return User::query()->hasAccess()->get();
});

// SAFE: hasAccess() with an argument, filtered
Route::get('/users-safe/search', function () {
    $status = request('status');

    return User::where('status', $status)->hasAccess(auth()->user())->get();
});

// VULNERABLE: matches custom rule `laravel-route-missing-middleware`
// No ->middleware() on the route, no enclosing group.
Route::get('/admin/reports', function () {
    return User::query()->hasAccess()->get();
});

// SAFE: middleware present — negative test case for the same rule
Route::get('/admin/reports-safe', function () {
    return User::query()->hasAccess()->get();
})->middleware('auth');
