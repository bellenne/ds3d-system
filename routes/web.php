<?php

use App\Http\Controllers\StickerPackCreator\StickerpackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


Route::get('/', function () {
    return view('homeView');
});

// Роуты для наклеек
Route::get('/stickers',[StickerpackController::class, "index"]);
Route::get('/stickers/generate',[StickerpackController::class, "generate"]);
Route::get('/stickers/download',[StickerpackController::class, "download"]);