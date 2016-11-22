<?php

namespace App\Http\Controllers;


use App\Call;
use Request, Session, DB, Validator, Input, Redirect, Crypt;
use App\Http\Controllers\Controller;
use App\Libraries\Common;

class AccountController extends Controller {
    public function edit_profile(){
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        $post_data['mobileno'] = "6328441060";
        $post_data = Input::get();
        $query = "SELECT pgc_halo.fn_register_subscriber(?,?,?,?,?,?,?,?,?,?,?,?) as is_kyc;";
        $values = array(
                    $post_data['firstname'],
                    $post_data['middlename'],
                    $post_data['lastname'],
                    $post_data['gender'],
                    $post_data['birthdate'],
                    $post_data['address'],
                    $post_data['city'],
                    $post_data['state'],
                    $post_data['postal'],
                    $post_data['country'],
                    $post_data['mobileno'],
                    $subscriber_id
                );
        $result = DB::select($query,$values);
        
        if ( $result[0]->is_kyc === TRUE ) {
            Session::put('archer_account_id',$post_data['mobileno']);
            $response = array("message" => "You successfully edited your profile.");
        } else {
            $response = array("message" => "Edit profile failed.");
        }
        return json_encode($response);
    }
    
    public function get_profile(){
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        $query = "SELECT * FROM pgc_halo.fn_get_subscriber_desc(?)
                  RESULT (subscriber_id integer, firstname character varying, middlename character varying, lastname character varying, gender character varying, birthday date, address character varying, city character varying,state character varying,postal_code character varying,country  character varying,archer_account_id character varying);";
        
        $values = array($subscriber_id);
        $result = DB::select($query,$values);
        return json_encode($result[0]);
    }
}