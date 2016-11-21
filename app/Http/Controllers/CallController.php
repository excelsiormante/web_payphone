<?php

namespace App\Http\Controllers;


use App\Call;
use Request, Session, DB, Validator, Input, Redirect, Crypt;
use App\Http\Controllers\Controller;
use App\Libraries\Common;

class CallController extends Controller {
    
    public function getSpeedDials(){
        $product_id = Input::get("product_id");
        $response = array(
                        "plans" => FALSE,
                        "selected_plan" => FALSE,
                        "speed_dials" => FALSE
                    );
        try {
            $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
            
            $json_myproducts = Common::callArcherAPI("http://10.251.14.197:8093/aog/getaccountinfo/anumber/IRB/6328441060/319");
            $myproducts = json_decode($json_myproducts);
            $my_products = $myproducts->productList;
            if ( count($my_products) > 0 ) {
                $dial_query = "SELECT * FROM pgc_halo.fn_get_my_speed_dials(?,?)
                               RESULT (dial_id integer, numpad varchar, bnumber varchar);";
                
                if ( $product_id === null ) {
                    $product_id = $my_products[0]->product_id;
                }
                $dial_values = array($subscriber_id, $product_id);
                $dial_result = DB::select($dial_query,$dial_values);
                $response['plans']         = $my_products;
                if ( $product_id === null ) {
                    $response['selected_plan'] = $my_products[0];
                } else {
                    foreach ($my_products as $key => $value) {
                        if ( $value->product_id == $product_id ) {
                            $response['selected_plan'] = $my_products[$key];
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
    
    public function dialCall(){
        $call_id = 0;
        $number = Input::get("dialedNumber");
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        $json_myproducts = Common::callArcherAPI("http://10.251.14.197:8093/aog/getaccountinfo/anumber/IRB/6328441060/319");
        $myproducts = json_decode($json_myproducts);
        $my_products = $myproducts->productList;
        if ( count($my_products) > 0 ) {
            // Choose what plan should be used
        } else {
            $query   = "SELECT pgc_halo.fn_call_number(?,?,?) call_id;";
            $values  = array($subscriber_id, 0, $number);
            $result  = DB::select($query,$values);
            $call_id = $result[0]->call_id;
        }
        $call   = array("call_id" => $call_id);
        return json_encode($call);
    }
    
    public function startCall(){
        $return = array(
                "result" => config('constants.RESULT_INITIAL'),
                "message" => ""
            );
        $call_id = Input::get("callId");
        $query   = "SELECT pgc_halo.fn_start_call(?) AS is_started;";
        $values  = array($call_id);
        $result  = DB::select($query,$values);
        if ( $result[0]->is_started ) {
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
    
    public function endCall(){
        $return = array(
                "result" => config('constants.RESULT_INITIAL'),
                "message" => ""
            );
        $call_id = Input::get("callId");
        $query   = "SELECT pgc_halo.fn_end_call(?) AS is_ended;";
        $values  = array($call_id);
        $result  = DB::select($query,$values);
        if ( $result[0]->is_ended ) {
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
    
    public function getLastDialedNumbers(){
        $query = "SELECT * FROM pgc_halo.fn_get_last_dialed_numbers(?)
                  RESULT (number varchar, dial_count bigint);";
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        $values = array($subscriber_id);
        $result = DB::select($query, $values);
        return json_encode($result);
    }
}
