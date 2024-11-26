<?php

namespace App\Http\Controllers\StickerPackCreator;

use Illuminate\Support\Facades\Storage;
use SVG\Nodes\Embedded\SVGImage;
use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;
class ImageGenerate{

    public function generateImage($articles, $rootDomen){
        ini_set('memory_limit', '-1');

        $size = $this->calculateSize($articles[array_key_last($articles)][1]);
        
        $image = imagecreatetruecolor($size["width"], $size["height"]);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image,0,0,$white);
        
        $stickersColumnCounter = 0;
        $stickersRowCounter = 0;
        $isFirstColumn = true;

        foreach($articles as $article){
            if($article[0]=="Всего:") break;
            $storageImage = Storage::disk("local")->path("stickers/".$article[0]."_наклейка.jpg");
            $sticker = imagecreatefromjpeg($storageImage);
           
            for($i=1; $i<=$article[1]; $i++){
                
                $stickersColumnCounter++;
                if($stickersColumnCounter % 11 == 0){
                    $stickersRowCounter++;
                    $isFirstColumn = true;
                    $stickersColumnCounter = 1;
                }
                
                $posX = 0;
                $posY = 0;

                if($isFirstColumn){ 
                    $posX = $size['spacer']; 
                    $isFirstColumn = false;
                }
                else{
                    $posX = $size['stickerSize'];
                    $posX *= $stickersColumnCounter-1;
                    $posX += $size['spacer']*$stickersColumnCounter;
                }
                if($stickersRowCounter<1) $posY = $size['spacer'];
                else {
                    $posY = $size['stickerSize'] * $stickersRowCounter;
                    $posY += $size['spacer'] * ($stickersRowCounter+1);
                }

                imagecopy($image, $sticker, $posX,$posY,0,0,$size['stickerSize'],$size['stickerSize']);
            }
        }
        // Записываем в буфер информацию о файле
        ob_start();
            imagejpeg($image);
            $stringdata = ob_get_contents();
        ob_end_clean();

        $filename = time();

        // Сохранение файла в хранилище
        Storage::disk("local")->put("public/stickers/jpeg/".$filename.".jpg", $stringdata);
        
        // Генерация SVG
        
        $image = new SVG($size["width"], $size["height"]);
        $doc = $image->getDocument();
        $bgImage = new SVGImage("$rootDomen/storage/$filename".".jpg", 0,0,$size["width"], $size["height"]);
        $doc->addChild($bgImage);

        
        return ["filename"=>$filename,"jpg"=>"$rootDomen/storage/$filename".".jpg", "svg"=>$this->SVGCreator($size, $articles, $doc, $image)];
    }

    private function SVGCreator($size, $articles, $doc, $image){
        $stickersColumnCounter = 0;
        $stickersRowCounter = 0;
        $isFirstColumn = true;


        foreach($articles as $article){
            if($article[0]=="Всего:") break;
            for($i=1; $i<=$article[1]; $i++){
                $stickersColumnCounter++;
                if($stickersColumnCounter % 11 == 0){
                    $stickersRowCounter++;
                    $isFirstColumn = true;
                    $stickersColumnCounter = 1;
                }

                $posX = 0;
                $posY = 0;

                if($isFirstColumn){ 
                    $posX = $size['spacer']-5; 
                    $isFirstColumn = false;
                }
                else{
                    $posX = $size['stickerSize'];
                    $posX *= $stickersColumnCounter-1;
                    $posX += $size['spacer']*$stickersColumnCounter;
                    $posX -=5;
                }
                if($stickersRowCounter<1) $posY = $size['spacer']-5;
                else {
                    $posY = $size['stickerSize'] * $stickersRowCounter;
                    $posY += $size['spacer'] * ($stickersRowCounter+1);
                    $posY -=5;
                }

                $square = new SVGRect($posX, $posY, $size["ceilSize"], $size["ceilSize"]);
                $square->setStyle('stroke', '#0000FF');
                $square->setStyle('fill', 'none');
                $doc->addChild($square);
            }
        }
        return $image;
    }


    private function calculateSize($countStickers){
        $width = 4900;

        $countLines = ceil($countStickers / 10);
        $spacer = 488-473;

        $height = $countLines * 488 +$spacer;

        return ["width"=> $width, "height"=> $height, "ceilSize"=>483, "stickerSize"=>473, "spacer"=>$spacer];
    }
}