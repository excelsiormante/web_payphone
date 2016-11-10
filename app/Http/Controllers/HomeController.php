<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB, Session;

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
        
        $country_query = "SELECT * FROM pgc_halo.fn_get_active_countries()
                          RESULT (id integer, name varchar);";
        $countries  = DB::select($country_query);
        $country_attr = array(
                            'name' => "country",
                            'class'=>"form-control"
                        );
        $cmb_country = \App\Libraries\Common::generateComboBox($country_attr, $countries);
        
        $subs_type_query = "SELECT * FROM pgc_halo.fn_get_active_subscriber_types()
                          RESULT (id integer, name varchar);";
        $subs_type  = DB::select($subs_type_query);
        $substype_attr = array(
                            'name' => "subs_type",
                            'class'=>"form-control"
                        );
        $cmb_subs_type = \App\Libraries\Common::generateComboBox($substype_attr, $subs_type);
        
        return view('auth.register')
        ->with('selectedBg', $selectedBg)
        ->with('cmb_country', $cmb_country)
        ->with('cmb_subs_type', $cmb_subs_type);
    }

    public function showDashboard()
    {
        $bg = array('bg-01.jpg', 'bg-02.jpg', 'bg-03.jpg', 'bg-04.jpg', 'bg-05.jpg', 'bg-06.jpg'); // array of filenames

        $i = rand(0, count($bg)-1); // generate random number size of the array
        $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen

        return view('dashboard')
        ->with('selectedBg', $selectedBg);
    }

 
}
