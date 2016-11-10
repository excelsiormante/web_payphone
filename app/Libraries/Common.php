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
}