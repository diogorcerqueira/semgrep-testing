<?php

// ok: laravel-missing-has-access-scope
Failure::query()->hasAccess()->get();

// ok: laravel-missing-has-access-scope
Failure::hasAccess()->get();

// ok: laravel-missing-has-access-scope
Failure::hasAccess($user)->get();

// ok: laravel-missing-has-access-scope
Failure::query()->hasAccess($user)->get();

// ok: laravel-missing-has-access-scope
Failure::where('status', 'open')->hasAccess()->get();

// ok: laravel-missing-has-access-scope
Failure::query()->where('status', 'open')->hasAccess()->orderBy('id')->get();

// ruleid: laravel-missing-has-access-scope
Failure::query()->get();

// ruleid: laravel-missing-has-access-scope
Failure::where('status', 'open')->get();

// ruleid: laravel-missing-has-access-scope
Failure::all();

// ruleid: laravel-missing-has-access-scope
Failure::find(1);

// ruleid: laravel-missing-has-access-scope
Failure::query()->where('status', 'open')->orderBy('id')->paginate(20);
