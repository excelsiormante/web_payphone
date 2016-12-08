<?php

namespace App\Http\Controllers;


use App\Plan;
use Request, Session, DB, Validator, Input, Redirect, Crypt, Mail;
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
        
        if ( Session::get('subs_status') !== config('constants.STATUS_ACTIVE') ) {
            $return = array(
                    "result"  => config('constants.RESULT_ERROR'),
                    "message" => "Please verify account first."
                );
        } else {
            $subscriber_id     = Crypt::decrypt(Session::get('subscriber_id'));
            $archer_account_id = Session::get('archer_account_id');
            $plan_price        = Input::get('plan_price');
            $plan_duration     = Input::get('plan_duration');
            $plan_id  = Input::get('plan_id');

            $query = "SELECT pgc_halo.fn_subscribe_to_plan(?,?,?,?) as is_subscribe;";
            $values = array($subscriber_id, $plan_id, $plan_price, $plan_duration);
            $result = DB::select($query, $values);
            $is_subscribe = $result[0]->is_subscribe;

            if ( $is_subscribe === TRUE ) {
                $subscribe = Common::callArcherAPI(config("constants.ARCHER_HOME_URL")."/aog/registerandenrollbyproductid/"
                                                  .config("constants.ARCHER_INSTANCE")."/"
                                                  .$archer_account_id."/"
                                                  .$plan_id."/"
                                                  .config("constants.ARCHER_DEALERID"));
                $subscription = json_decode($subscribe);

                Mail::send('emails.subscription', array(), function($mail) {                    
                    $mail->to(Session::get('email'), Session::get('name'))->subject("Web Pay Phone Subscription");
                });

                if ( $subscription->resultCode->status === TRUE ) {
                    $return = array(
                            "result" => config('constants.RESULT_SUCCESS'),
                            "message" => "Successfully Subscribe."
                        );
                } else {
                    $return = array(
                            "result" => config('constants.RESULT_ERROR'),
                            "message" => $subscription->resultCode->errorMessage
                        );
                }
            } else {
                $return = array(
                        "result"  => config('constants.RESULT_ERROR'),
                        "message" => "Insufficient Balance."
                    );
            }
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
                    if ( !isset($myplan[$value->productType]) ) {
                        $myplan[$value->productType] = array(
                                                            'product_id'     => $value->productId,
                                                            'remaining_days' => $value->validityDays
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
