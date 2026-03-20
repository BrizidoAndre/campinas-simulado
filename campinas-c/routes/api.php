<?php

use App\bases\ApiResponse;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// declaring public routes

// user public routes
Route::any('/login', [AuthController::class, 'login']);
Route::any('/register', [AuthController::class, 'register']);

// albums related Routes
Route::get('albums', [AlbumController::class, 'index']);
Route::get('albums/{album}', [AlbumController::class, 'show'])->missing(function () {
    ApiResponse::errorResponse(404, 'Not found');
});
//todo th
Route::get('albums/{album}/cover', [AlbumController::class, 'cover'])->missing(function () {
    ApiResponse::errorResponse(404, 'Cover not found');
});
Route::get('albums/{album}/songs', [AlbumController::class, 'songs'])->missing(function () {
    ApiResponse::errorResponse(404, 'Not found');
});
// songs related routes
Route::get('songs', [SongController::class, 'index']);
Route::get('songs/{song}/cover', [SongController::class, 'cover'])->missing(function () {
    ApiResponse::errorResponse(404, 'Cover not found');
});

// user related routes
Route::middleware(AuthMiddleware::class)->group(function () {
//    required user simple authentication
    Route::any('/logout', [AuthController::class, 'logout']);
//    songs related routes
    Route::get('songs/{song}', [SongController::class, 'show'])->missing(function () {
        ApiResponse::errorResponse(404, 'Not found');
    });
    Route::get('statistics', [SongController::class, 'statistics']);

//        required ADMIN role
    Route::middleware(IsAdminMiddleware::class)->group(function () {
//        user related routes
        Route::any('/users', [UsersController::class, 'index']);
        Route::put('/users/{users}', [UsersController::class, 'update'])->missing(function () {
            ApiResponse::errorResponse(404, 'User not found');
        });
        Route::put('/users/{users}/ban', [UsersController::class, 'ban'])->missing(function () {
            ApiResponse::errorResponse(404, 'User not found');
        });
        Route::put('/users/{users}/unban', [UsersController::class, 'unban'])->missing(function () {
            ApiResponse::errorResponse(404, 'User not found');
        });

//        albums related routes
        Route::post('/albums', [AlbumController::class, 'store']);
        Route::put('/albums/{album}', [AlbumController::class, 'update'])->missing(function () {
            ApiResponse::errorResponse(404, 'Not found');
        });
        Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->missing(function () {
            ApiResponse::errorResponse(404, 'Not found');
        });

//        SONGS related routes
        Route::post('/albums/{album}/songs', [SongController::class, 'store'])->missing(function () {
            ApiResponse::errorResponse(404, 'Not found');
        });
        Route::put('/albums/{album}/songs/order', [SongController::class, 'updateOrder'])->missing(function () {
            ApiResponse::errorResponse(404, 'Not found');
        });
        Route::post('/albums/{album}/songs/{song}', [SongController::class, 'update'])->missing(function () {
            ApiResponse::errorResponse(404, 'Not found');
        });
        Route::delete('/albums/{album}/songs/{song}', [SongController::class, 'destroy'])->missing(function () {
            ApiResponse::errorResponse(404, 'Not found');
        });
    });
});
