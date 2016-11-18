<?php

namespace App\Http\Controllers;


use App\Plan;
use Request, Session, DB, Validator, Input, Redirect, Crypt;
use App\Http\Controllers\Controller;
use App\Libraries\Common;

class PlansController extends Controller {

    public function index(){
        $plans = array();
        $json_products = Common::callArcherAPI("10.251.14.197:8093/aog/getproducts/IRB/dealerid=319");
        $products = json_decode($json_products);
        if ( $products->resultCode->errorCode === 0 ) {
            foreach ($products->productDefList as $value) {
                foreach ($value->paramList as $key => $params) {
                    if ( $params->paramName === "ExpirationPeriod" ) {
                        $duration = $params->paramValue * 24 * 60 * 60;
                        break;
                    }
                }
                if ( isset($plans[$value->productType]) ) {
                    $plan_details = array(
                                                    'id'              => $value->productId,
                                                    'name'            => $value->productVariantName,
                                                    'description'     => $value->description,
                                                    'price'           => $value->productPrice,
                                                    'duration'        => $duration
                                                );
                    array_push($plans[$value->productType], $plan_details);
                } else {
                    $plans[$value->productType][0] = array(
                                                    'id'              => $value->productId,
                                                    'name'            => $value->productVariantName,
                                                    'description'     => $value->description,
                                                    'price'           => $value->productPrice,
                                                    'duration'        => $duration
                                                );
                }
            }
        }
        
        return json_encode($plans);
    }

    public function subscribe(){
        $return = array(
            "result" => config('constants.RESULT_INITIAL'),
            "message" => ""
        );
        $plan_id       = Input::get('plan_id');
        $price    = Input::get('plan_price');
        $duration = Input::get('plan_duration');
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        try {
            $query = "SELECT pgc_halo.fn_subscribe_to_plan(?,?,?,?) as is_subscribe;";
            $values = array($subscriber_id, $plan_id, $price, $duration);
            $result = DB::select($query, $values);
            if ( $result[0]->is_subscribe ) {
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
        } catch ( Exception $exc ) {
            
        }
        return json_encode($return);
    }
    
    public function myPlans(){
        $myplan = array();
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        
        $json_myproducts = Common::callArcherAPI("http://10.251.14.197:8093/aog/getaccountinfo/anumber/IRB/6328441060/319");
        $myproducts = json_decode($json_myproducts);
        $my_products = $myproducts->productList;
        if ( count($my_products) > 0 ) {
            foreach ($my_products as $value) {
                    if ( isset($myplan[$value->product_type]) ) {
                        $plan_details = array(
                                                        'product_id'     => $value->product_id,
                                                        'name'           => $value->name,
                                                        'description'    => $value->description,
                                                        'remaining_mins' => $value->remaining_mins
                                                    );
                        array_push($myplan[$value->product_type], $plan_details);
                    } else {
                        $myplan[$value->product_type][0] = array(
                                                        'product_id'     => $value->product_id,
                                                        'name'           => $value->name,
                                                        'description'    => $value->description,
                                                        'remaining_mins' => $value->remaining_mins
                                                    );
                    }
                }
            }
        return json_encode($myplan);
    }
}
