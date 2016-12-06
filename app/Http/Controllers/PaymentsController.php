<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Redirect, response;
use App\Libraries\Paymaya;
use App\Libraries\PaymayaTransfer;
use DB, Session, Crypt;
use App\Libraries\Common;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function PaypalExpressCheckout($amount)
    {
        if ( Session::get('subs_status') !== config('constants.STATUS_ACTIVE') ) {
            $return = Redirect::to('app')->with("failed_message", "Please verify account first.");
        } else {
            $provider = new ExpressCheckout; 

            $add_trans_query = "SELECT pgc_halo.fn_insert_ewallet_transaction(?,?,?) as trans_id;";
            $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
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
        
        $upd_trans_query = "SELECT pgc_halo.fn_update_ewallet_transaction(?,?,?,?) as trans_id;";
        if ( $response['ACK'] === "Success" ) {
            $result = config('constants.RESULT_SUCCESS');
            $payment_result = $response['PAYMENTINFO_0_ERRORCODE'];
            $status = "success_message";
            $message = "Payment Successful";
        } else {
            $result = config('constants.RESULT_ERROR');
            $payment_result = $response['L_ERRORCODE0'];
            $status = "failed_message";
            $message = "Payment Fail";
        }
        $upd_trans_values = array($trans_data['invoice_id'], $result, $response['CORRELATIONID'], $payment_result);
        DB::select($upd_trans_query, $upd_trans_values);
        session()->forget($input['token']);
        $return = Redirect::to('app')->with($status, $message);
        return $return;
    }


    public function PaymayaCheckout($amount)
    {
        if ( Session::get('subs_status') !== config('constants.STATUS_ACTIVE') ) {
            $return = Redirect::to('app')->with("failed_message", "Please verify account first.");
        } else {
            $add_trans_query = "SELECT pgc_halo.fn_insert_ewallet_transaction(?,?,?) as trans_id;";
            $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
            $add_trans_values = array($subscriber_id, $amount, "PAYMAYA");
            $add_trans_result = DB::select($add_trans_query, $add_trans_values);
            $transaction_id = $add_trans_result[0]->trans_id;
            $query = "SELECT * FROM pgc_halo.fn_get_subscriber_desc(?)
                      RESULT (subscriber_id integer, firstname character varying, middlename character varying, lastname character varying, gender character varying, birthday date, ewallet double precision, email_address character varying, address character varying, city character varying,state character varying,postal_code character varying,country  character varying,archer_account_id character varying, status integer);";

            $values = array($subscriber_id);
            $result = DB::select($query,$values);

            $subscriber = array(
                            "firstName"  => $result[0]->firstname,
                            "middleName" => $result[0]->middlename,
                            "lastName"   => $result[0]->lastname,
                            "phone"      => $result[0]->archer_account_id,
                            "email"      => $result[0]->email_address,
                            "transId"    => $transaction_id,
                            "IpAdd"      => Common::get_client_ip()
                        );

            $response = Paymaya::checkout($amount, $subscriber);
            if ( $response !== NULL ) {
                session()->put('transactionId', $transaction_id);
                session()->put('checkoutId', $response['checkoutId']);
                $return = redirect($response['redirectUrl']);
            } else {
                $upd_trans_query = "SELECT pgc_halo.fn_update_ewallet_transaction(?,?,?,?) as trans_id;";
                $upd_trans_values = array($transaction_id, config('constants.RESULT_ERROR'), '0', '0');
                DB::select($upd_trans_query, $upd_trans_values);
                $return = redirect('/app');
            }
        }
        return $return;
    }

    public function PaymayaSuccessCheckout()
    {
        $upd_trans_query = "SELECT pgc_halo.fn_update_ewallet_transaction(?,?,?,?) as trans_id;";
        $upd_trans_values = array(session('transactionId'), config('constants.RESULT_SUCCESS'), session('checkoutId'), '0');
        DB::select($upd_trans_query, $upd_trans_values);
        session()->forget('transactionId');
        session()->forget('checkoutId');
        return redirect('/app');
    }

    public function PaymayaFailCheckout()
    {
        $upd_trans_query = "SELECT pgc_halo.fn_update_ewallet_transaction(?,?,?,?) as trans_id;";
        $upd_trans_values = array(session('transactionId'), config('constants.RESULT_ERROR'), session('checkoutId'), '0');
        DB::select($upd_trans_query, $upd_trans_values);
        session()->forget('transactionId');
        session()->forget('checkoutId');
        return redirect('/app');
    }

 

    public function PaymayaTransfer()
    {
        
        $create = PaymayaTransfer::CreateTransfer();
        $execute = PaymayaTransfer::ExecuteTransfer($create['transferId']);
        //return redirect($response['redirectUrl']);
    }

 
}
