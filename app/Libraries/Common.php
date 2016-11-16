<?php

namespace App\Libraries;

use DB;

class Common {
    public static function generateComboBox($attributes, $data, $selected = FALSE){
        $html = "<select";
        foreach ($attributes as $name => $value) {
            $html .= " ".$name."='".$value."'";
        }
        $html .= ">";
        foreach ($data as $options) {
            $html .= "<option value='".$options->id."'>".$options->name."</option>";
        }
        $html .= "</select>";
        return $html;
    }
    
    public static function callArcherAPI($apiUrl) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, config("constants.ARCHER_USERNAME") . ":" . config("constants.ARCHER_PASSWORD"));
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        
        return $result;
    }
}