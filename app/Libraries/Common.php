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
    
    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}