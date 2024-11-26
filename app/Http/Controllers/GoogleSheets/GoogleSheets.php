<?php
namespace App\Http\Controllers\GoogleSheets;

use Storage;
class GoogleSheets
{
    protected $service;
    
    protected function authorization(){
        $service_key = Storage::json("service_key.json");
        $client = new \Google_Client();
        $client->setApplicationName('Google Sheets API');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig($service_key);
        $service = new \Google_Service_Sheets($client);

        return $service;
    }
}
