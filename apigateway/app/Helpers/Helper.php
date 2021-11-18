<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Config;

class Helper
{
    public static function token(String $string)
    {
        $base64Url = explode (".", $string);
        $decode = base64_decode($base64Url[1]);
        $userId = json_decode($decode)->userId;
        return $userId;
    }

    public static function service(String $string){
        $service = explode ("/", $string);
        if($service[0] == ''){
            return false;    
        }  
        return $service[0];
    }

    public static function publicEndpoints($enp){
        $endpoints = config('gateway.endpoints');
        $host = false;
        foreach($endpoints as $endpoint => $value){
            if(strtolower($endpoint) == strtolower($enp)){
                $host = $value;
            }
        }
        return $host;
    }
}