<?php

namespace App\Http\Controllers\StickerPackCreator;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StickerPackCreator\GoogleSheetsSupply;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Storage;
use App\Traits\Upload;


class StickerpackController extends Controller
{
    public function index(){
        return view("StickerPacks/index");
    }

    public function generate(Request $request){
        // Получение списка для подготовки наклеек

        $googlesheets = new GoogleSheetsSupply();
        $values = $googlesheets->getArcticles($request->query("sheets_id"), $request->query("range"));

        // Генерация Jpg и SVG

        $img = new ImageGenerate();
        $imagesData = $img->generateImage($values, $request->root());

        Storage::disk("local")->put("public/stickers/svg/".$imagesData['filename'].".svg", $imagesData['svg']);
        $filename = $imagesData['filename'];

        return view("StickerPacks/download", ["filename"=>$filename]);
    }

    public function download(Request $request){
        $type = $request->query("type");
        $filename = $request->query("filename");
        if($type == "jpeg") return Storage::download("public/stickers/$type/".$filename.".jpg", "$filename.jpg");
        
        return Storage::download("public/stickers/$type/".$filename.".$type", "$filename.$type");
    }

    public function add(){
        return view("StickerPacks/add");
    }

    public function upload(Request $request){
        $files = $request->file("files");
        foreach($files as $file){
            Storage::disk("local")->putFileAs("stickers",$file,$file->getClientOriginalName()) ;
        }
        return redirect()->back();
    }
}
