<?php

namespace App\Http\Controllers\StickerPackCreator;

use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipCreator{
    public function zipCreator($filename){
        $zip = new ZipArchive;
        
        $zipName = public_path()."/stickers/zip/$filename.zip";

        // $files = File::files(());
        $files = Storage::file("public/stickers/jpeg/$filename.jpeg");
        dd($files);

        // if($zip->open($zipName, ZipArchive::CREATE) === TRUE){
        //     // $jpeg = "public/stickers/jpeg/$filename.jpeg";
        //     $jpeg = storage_path("stickers/jpeg/$filename.jpeg");
        //     $svg = "public/stickers/svg/$filename.svg";
        //     if( file_exists(Storage::path("public/stickers/jpeg/$filename.jpeg")) ){ 
        //         // $zip->addFile(public_path("stickers/jpeg/$filename.jpeg"));
        //         dd("exists");
        //     }    // dd($jpeg);
        //     // $zip->addFile($svg,"Контуры.svg");
        //     $zip->close();
        // }

        // return Storage::download($zipName);
    }
}