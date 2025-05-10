<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\Api\ApiBarangController;
use App\Http\Controllers\ApiPeminjamanController;
use App\Http\Controllers\PengembalianApiController;


Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/peminjaman', [ApiPeminjamanController::class, 'store']);
    Route::get('/riwayat-peminjaman', [ApiPeminjamanController::class, 'riwayat']);
    Route::get('/barangs', [ApiBarangController::class, 'index']);
});
Route::middleware('auth:sanctum')->post('/pengembalian', [PengembalianApiController::class, 'store']);
Route::middleware('auth:sanctum')->get('/users', function () {
    return User::all();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
