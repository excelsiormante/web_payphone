<?php

namespace App\Http\Controllers;


use App\Call;
use Request, Session, DB, Validator, Input, Redirect, Crypt;
use App\Http\Controllers\Controller;
use App\Libraries\Common;

class AccountController extends Controller {
    public function edit_profile(){
        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        $archer_account_id = "6328441060";
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
                    $archer_account_id,
                    $subscriber_id
                );
        $result = DB::select($query,$values);
        
        if ( $result[0]->fn_register_subscriber === TRUE ) {
            Session::put('archer_account_id',$archer_account_id);
        } else {
            
        }
    }
}