<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB, Session, Crypt;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $bg = array('bg-01.jpg', 'bg-02.jpg', 'bg-03.jpg', 'bg-04.jpg', 'bg-05.jpg', 'bg-06.jpg'); // array of filenames

        $i = rand(0, count($bg)-1); // generate random number size of the array
        $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
        
        if ( Session::get('with_reg') ) {
            // Add Please check your email to complete your registration message
        }
        
        return view('auth.login')
        ->with('selectedBg', $selectedBg);
    }


    public function getRegister()
    {
        $bg = array('bg-01.jpg', 'bg-02.jpg', 'bg-03.jpg', 'bg-04.jpg', 'bg-05.jpg', 'bg-06.jpg'); // array of filenames

        $i = rand(0, count($bg)-1); // generate random number size of the array
        $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
        
        return view('auth.register')
        ->with('selectedBg', $selectedBg);
    }

    public function showDashboard()
    {
        $bg = array('bg-01.jpg', 'bg-02.jpg', 'bg-03.jpg', 'bg-04.jpg', 'bg-05.jpg', 'bg-06.jpg'); // array of filenames

        $i = rand(0, count($bg)-1); // generate random number size of the array
        $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen

        $subscriber_id = Crypt::decrypt(Session::get('subscriber_id'));
        $query = "SELECT * FROM pgc_halo.fn_get_wallet_balance(?) AS balance";
        $values = array($subscriber_id);
        $result = DB::select($query,$values);
        $balance = number_format((float)$result[0]->balance, 2, '.', '');
        
        return view('dashboard')
        ->with('selectedBg', $selectedBg)
        ->with('fullname',Session::get('name'))
        ->with('balance', $balance);
    }

 
}
