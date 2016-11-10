<?php

namespace App\Http\Controllers;


use App\Wallet;
use Request, Session, DB, Validator, Input, Redirect;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function getwallet()
    {
        try {
            $subscriber_id = 1;
            $query = "SELECT * FROM pgc_halo.fn_get_wallet_balance(?) AS balance";
            $values = array($subscriber_id);
            $result = DB::select($query,$values);
            $response = array('balance' => $result[0]->balance);
        } catch (Exception $exc) {
            
        }
        return json_encode($response);
    }

}
