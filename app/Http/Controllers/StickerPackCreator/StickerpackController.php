<?php

namespace App\Http\Controllers\StickerPackCreator;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StickerPackCreator\GoogleSheetsSupply;
use Illuminate\Http\Request;
use Storage;
use SVG\Nodes\Embedded\SVGImage;


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
}
