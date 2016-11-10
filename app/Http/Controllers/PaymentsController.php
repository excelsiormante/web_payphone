<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use redirect, response;
use App\Libraries\Paymaya;
use DB, Session;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function PaypalExpressCheckout($amount)
    {

        $provider = new ExpressCheckout; 

        $add_trans_query = "SELECT pgc_halo.fn_insert_ewallet_transaction(?,?,?) as trans_id;";
        $subscriber_id = Session::get('subsciber_id');
        $add_trans_values = array($subscriber_id, $amount, "PAYPAL");
        $add_trans_result = DB::select($add_trans_query, $add_trans_values);
        $transaction_id = $add_trans_result[0]->trans_id;
        
        $data = [];
        $data['items'] = [
            [
                'name'  => 'E-wallet load',
                'price' => $amount,
                'qty'   => 1
            ]
        ];

        $data['invoice_id'] = $transaction_id;
        $data['invoice_description'] = "Order #".$data['invoice_id']."Invoice";
        $data['return_url'] = url('paypal/success');
        $data['cancel_url'] = url('/');

        $total = 0;

        foreach($data['items'] as $item) {
            $total += $item['price'];
        }

        $data['total'] = $total;

        $response = $provider->setExpressCheckout($data);
        if ( $response['ACK'] === "Success" ) {
            // Here you store it in session with session helper, with the key as transaction token.
            session()->put($response['TOKEN'], $data);

            $return = redirect($response['paypal_link']);
        } else {
            $upd_trans_query = "SELECT pgc_halo.fn_update_ewallet_transaction(?,?,?,?) as trans_id;";
            $upd_trans_values = array($transaction_id, config('constants.RESULT_ERROR'), $response['CORRELATIONID'], $response['L_ERRORCODE0']);
            DB::select($upd_trans_query, $upd_trans_values);
            $return = redirect('/');
        }
        return $return;
    }

    public function PaypaldoExpressCheckoutPayment(Request $request)
    {
        $input = $request->all();
        $provider = new ExpressCheckout; 
      
        $trans_data = session($input['token']);
        //execute express checkout payment
        $response = $provider->doExpressCheckoutPayment($trans_data, $input['token'], $input['PayerID']);
        //$response = $provider->getExpressCheckoutDetails($token);
        if ( $response['ACK'] === "Success" ) {
            $upd_trans_query = "SELECT pgc_halo.fn_update_ewallet_transaction(?,?,?,?) as trans_id;";
            $upd_trans_values = array($trans_data['invoice_id'], config('constants.RESULT_SUCCESS'), $response['CORRELATIONID'], $response['PAYMENTINFO_0_ERRORCODE']);
            DB::select($upd_trans_query, $upd_trans_values);
            $return = redirect('/');
        } else {
            $upd_trans_query = "SELECT pgc_halo.fn_update_ewallet_transaction(?,?,?,?) as trans_id;";
            $upd_trans_values = array($trans_data['invoice_id'], config('constants.RESULT_ERROR'), $response['CORRELATIONID'], $response['L_ERRORCODE0']);
            DB::select($upd_trans_query, $upd_trans_values);
            $return = redirect('/');
        }
        return $return;
    }


    public function PaymayaCheckout($amount)
    {
        $response = Paymaya::checkout($amount);



        return redirect($response['redirectUrl']);
    }

    public function PaymayaSuccessCheckout()
    {
        dd(Request::all());
    }

 
}
