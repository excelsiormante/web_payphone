<?php

namespace App\Http\Controllers;


use App\Plan;
use Request, Session, DB, Validator, Input, Redirect, Crypt;
use App\Http\Controllers\Controller;
use App\Libraries\Common;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index(){
        $plans = array();
        $json_products = Common::callArcherAPI("10.251.14.197:8093/aog/getproducts/IRB/dealerid=319");
        $products = json_decode($json_products);
        if ( $products->resultCode->errorCode === 0 ) {
            foreach ($products->productDefList as $value) {
                if ( isset($plans[$value->productType]) ) {
                    $plan_details = array(
                                                    'id'              => $value->productId,
                                                    'name'            => $value->productVariantName,
                                                    'description'     => $value->description,
                                                    'price'           => $value->productPrice
                                                );
                    array_push($plans[$value->productType], $plan_details);
                } else {
                    $plans[$value->productType][0] = array(
                                                    'id'              => $value->productId,
                                                    'name'            => $value->productVariantName,
                                                    'description'     => $value->description,
                                                    'price'           => $value->productPrice
                                                );
                }
            }
        }
        
        return json_encode($plans);
    }

    public function getDescription(){
        $plan = array();
        try {
            $plan_id = Input::get('plan_id');
            $query = "SELECT * FROM pgc_halo.fn_get_product_desc(?)
                      RESULT (product_id integer, code varchar, name varchar, description text, price double precision, product_type varchar, call_duration integer, nominations integer, plan_duration integer, status integer);";
            $values = array($plan_id);
            $result = DB::select($query, $values);
            $plan = $result[0];
        } catch (Exception $exc) {
            
        }
        return json_encode($plan);
    }
    
    public function subscribe(){
        $return = array(
            "result" => config('constants.RESULT_INITIAL'),
            "message" => ""
        );
        $plan_id       = Input::get('plan_id');
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        try {
            $query = "SELECT pgc_halo.fn_subscribe_to_plan(?,?) as is_subscribe;";
            $values = array($subscriber_id, $plan_id);
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
        
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_my_plans(?)
                      RESULT (product_id integer, code varchar, name varchar, description text, product_type varchar, remaining_mins integer);";
            $values = array($subscriber_id);
            $result = DB::select($query, $values);
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
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
        } catch (Exception $exc) {
            
        }
        return json_encode($myplan);
    }
}
