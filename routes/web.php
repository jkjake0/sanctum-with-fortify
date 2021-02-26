<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Custom Fortify Logout
Route::post('/' . config('fortify.prefix') . '/logout', function (Illuminate\Http\Request $request) {
    $token = App\Models\Sanctum\PersonalAccessToken::findToken($request->bearerToken());
    App\Models\Sanctum\PersonalAccessToken::destroy($token->id);
    return app(\Laravel\Fortify\Contracts\LogoutResponse::class);
})->withoutMiddleware([
    \App\Http\Middleware\VerifyCsrfToken::class
])->middleware('auth:sanctum');
