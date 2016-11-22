<?php

namespace App\Http\Controllers;


use App\Plan;
use Request, Session, DB, Validator, Input, Redirect, Crypt;
use App\Http\Controllers\Controller;
use App\Libraries\Common;

class PlansController extends Controller {
    
    public function index(){
        $plans = array();
        $json_products = Common::callArcherAPI(config("constants.ARCHER_HOME_URL")."/aog/getproducts/"
                                              .config("constants.ARCHER_INSTANCE")."/"
                                              ."dealerid=".config("constants.ARCHER_DEALERID"));
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
        $plan_id  = Input::get('plan_id');
        $archer_account_id = Session::get('archer_account_id');
        $subscribe = Common::callArcherAPI(config("constants.ARCHER_HOME_URL")."/aog/registerandenrollbyproductid/"
                                          .config("constants.ARCHER_INSTANCE")."/"
                                          .$archer_account_id."/"
                                          .$plan_id."/"
                                          .config("constants.ARCHER_DEALERID"));
        $subscription = json_decode($subscribe);
        if ( $subscription->resultCode->status === TRUE ) {
            $return = array(
                    "result" => config('constants.RESULT_SUCCESS'),
                    "message" => "Successfully Added."
                );
        } else {
            $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => $subscription->resultCode->errorMessage
                );
        }
        return json_encode($return);
    }
    
    public function myPlans(){
        $myplan = array();
        $archer_account_id = Session::get('archer_account_id');
        
        $json_myproducts = Common::callArcherAPI(config("constants.ARCHER_HOME_URL")."/aog/getaccountinfo/anumber/"
                                                .config("constants.ARCHER_INSTANCE")."/"
                                                .$archer_account_id."/"
                                                .config("constants.ARCHER_DEALERID"));
        $myproducts = json_decode($json_myproducts);
        if ( $myproducts->resultCode->status === TRUE ) {
            $my_products = $myproducts->productList;
            if ( count($my_products) > 0 ) {
                foreach ($my_products as $value) {
                    if ( isset($myplan[$value->productType]) ) {
                        $plan_details = array(
                                                        'product_id'     => $value->productId,
                                                        'remaining_mins' => $value->validityDays
                                                    );
                        array_push($myplan[$value->productType], $plan_details);
                    } else {
                        $myplan[$value->productType][0] = array(
                                                        'product_id'     => $value->productId,
                                                        'remaining_mins' => $value->validityDays
                                                    );
                    }
                }
            }
            $return = array(
                    "result"  => config('constants.RESULT_SUCCESS'),
                    "message" => "",
                    "data"    => $myplan
                );
        } else if ( $myproducts->resultCode->errorCode === 10031 ) {
            $return = array(
                    "result"  => config('constants.RESULT_ERROR'),
                    "message" => "KYC process is needed to be able to access this module",
                    "data"    => array()
                );
        } else {
            $return = array(
                    "result"  => config('constants.RESULT_ERROR'),
                    "message" => $myproducts->resultCode->errorMessage,
                    "data"    => array()
                );
        }
        return json_encode($return);
    }
}
