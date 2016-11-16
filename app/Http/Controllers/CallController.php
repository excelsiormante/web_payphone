<?php

namespace App\Http\Controllers;


use App\Call;
use Request, Session, DB, Validator, Input, Redirect, Crypt;
use App\Http\Controllers\Controller;

class CallController extends Controller {
    
    public function getSpeedDials()
    {
        $product_id = Input::get("product_id");
        $response = array(
                        "plans" => FALSE,
                        "selected_plan" => FALSE,
                        "speed_dials" => FALSE
                    );
        try {
            $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
            
            $plans_query = "SELECT * FROM pgc_halo.fn_get_my_plans(?)
                            RESULT (product_id integer, code varchar, name varchar, description text, product_type varchar, remaining_mins integer);";
            
            $plans_values = array($subscriber_id);
            $plans_result = DB::select($plans_query, $plans_values);
            if ( count($plans_result) > 0 ) {
                $dial_query = "SELECT * FROM pgc_halo.fn_get_my_speed_dials(?,?)
                               RESULT (dial_id integer, numpad varchar, bnumber varchar);";
                
                if ( $product_id === null ) {
                    $product_id = $plans_result[0]->product_id;
                }
                $dial_values = array($subscriber_id, $product_id);
                $dial_result = DB::select($dial_query,$dial_values);
                $response['plans']         = $plans_result;
                if ( $product_id === null ) {
                    $response['selected_plan'] = $plans_result[0];
                } else {
                    foreach ($plans_result as $key => $value) {
                        if ( $value->product_id == $product_id ) {
                            $response['selected_plan'] = $plans_result[$key];
                            break;
                        }
                    }
                }
                if ( count($dial_result) > 0 ) {      
                    $response['speed_dials']   = $dial_result;
                }
            }
        } catch (Exception $exc) {
            
        }
        return json_encode($response);
    }
    
    public function addSpeedDial(){
        $return = array(
                    "result" => config('constants.RESULT_INITIAL'),
                    "message" => ""
                );
        $product_id = Input::get("product_id");
        $speed_dial_number = Input::get("speed_dial_number");
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        $query = "SELECT pgc_halo.fn_add_speed_dial(?,?,?) as is_added;";
        $values = array($subscriber_id, $product_id, $speed_dial_number);
        $result = DB::select($query, $values);
        if ( $result[0]->is_added ) {
            $return = array(
                    "result" => config('constants.RESULT_SUCCESS'),
                    "message" => "Successfully Added."
                );
        } else {
            $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => ""
                );
        }
        
        return json_encode($return);
    }
}
