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
Route::get('/stickers/download',[StickerpackController::class, "download"])->name("downloadStickers");
Route::get('/stickers/add',[StickerpackController::class, "add"])->name("addStickers");
Route::post('/stickers/upload',[StickerpackController::class, "upload"])->name("uploadStickers");