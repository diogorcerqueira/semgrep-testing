<?php

// ruleid: laravel-route-missing-middleware
Route::get('/x', function () {
    return 'x';
});

// ruleid: laravel-route-missing-middleware
Route::post('/y', [Controller::class, 'store']);

// ruleid: laravel-route-missing-middleware
Route::any('/multi', function () {
    return 'multi';
});

// ok: laravel-route-missing-middleware
Route::get('/x', function () {
    return 'x';
})->middleware('auth');

// ok: laravel-route-missing-middleware
Route::get('/x', function () {
    return 'x';
})->name('x')->middleware('auth');

// ruleid: laravel-route-missing-middleware
Route::get('/x', function () {
    return 'x';
})->middleware([]);

// ok: laravel-route-missing-middleware
Route::middleware('auth')->group(function () {
    Route::get('/x', function () {
        return 'x';
    });
});

// ok: laravel-route-missing-middleware
Route::middleware([])->group(function () {
    // ruleid: laravel-route-missing-middleware
    Route::get('/x', function () {
        return 'x';
    });
});

// ok: laravel-route-missing-middleware
Route::group(['middleware' => 'auth'], function () {
    Route::get('/x', function () {
        return 'x';
    });
});

// ok: laravel-route-missing-middleware
Route::group(['prefix' => 'api', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/x', function () {
        return 'x';
    });
});

// ok: laravel-route-missing-middleware
Route::group(['prefix' => 'api'], function () {
    // ruleid: laravel-route-missing-middleware
    Route::get('/x', function () {
        return 'x';
    });
});

// ok: laravel-route-missing-middleware
Route::group(['prefix' => 'api', 'middleware' => []], function () {
    // ruleid: laravel-route-missing-middleware
    Route::get('/x', function () {
        return 'x';
    });
});

// ok: laravel-route-missing-middleware
Route::match(['get', 'post'], '/m', function () {
    return 'm';
})->middleware('throttle:60,1');

// ok: laravel-route-missing-middleware
// Nested group has no middleware key of its own, but it inherits 'web'
// from the outer group at runtime — Laravel merges parent group
// middleware into nested groups, so this is genuinely protected.
Route::group(['middleware' => 'web'], function () {
    Route::group(['prefix' => 'admin'], function () {
        // ok: laravel-route-missing-middleware
        Route::get('/x', function () {
            return 'x';
        });
    });
});
