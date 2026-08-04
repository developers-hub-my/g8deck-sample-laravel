<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/status', function () {
    return response()->json([
        'app' => 'laravel-demo',
        'framework' => 'Laravel '.app()->version(),
        'php' => PHP_VERSION,
        'database' => [
            'driver' => DB::connection()->getDriverName(),
            'migrations' => DB::table('migrations')->count(),
        ],
        'cache' => [
            'store' => config('cache.default'),
            'visits' => Cache::increment('demo:visits'),
        ],
    ]);
});
