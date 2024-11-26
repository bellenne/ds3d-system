<?php
namespace App\Http\Controllers\StickerPackCreator;
use App\Http\Controllers\GoogleSheets\GoogleSheets;
class GoogleSheetsSupply extends GoogleSheets{
    public function __construct(){
        $this->service = $this->authorization();
    }

    public function getArcticles($spreadsheetId, $range){
        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);

        return $response->values;
    }
}