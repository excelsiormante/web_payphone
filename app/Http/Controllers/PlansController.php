<?php

namespace App\Http\Controllers;


use App\Plan;
use Request, Session, DB, Validator, Input, Redirect;
use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $plans = array();
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_products()
                      RESULT (id integer, code varchar, name varchar, description text, price float, product_type varchar, call_duration varchar, nominations integer, plan_duration varchar, status integer);";
            $result = DB::select($query);
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
                    $call_duration_total = $value->call_duration;
                    $call_duration_total = $call_duration_total / 60;
                    $call_duration_minutes = floor($call_duration_total % 60);   
                    $call_duration_total = $call_duration_total / 60;
                    $call_duration_hours = floor($call_duration_total % 24);
                    $call_duration_days = floor($call_duration_total / 24);

                    
                    $plan_duration_total = $value->plan_duration;
                    $plan_duration_total = $plan_duration_total / 60;
                    $plan_duration_minutes = floor($plan_duration_total % 60);   
                    $plan_duration_total = $plan_duration_total / 60;
                    $plan_duration_hours = floor($plan_duration_total % 24);
                    $plan_duration_days = floor($plan_duration_total / 24);
                    
                    if ( isset($plan[$value->product_type]) ) {
                        $plan_details = array(
                                                        'id'              => $value->id,
                                                        'code'            => $value->code,
                                                        'name'            => $value->name,
                                                        'description'     => $value->description,
                                                        'nominations'     => $value->status,
                                                        'price'           => $value->price,
                                                        'airtime_days'    => $call_duration_days,
                                                        'airtime_hours'   => $call_duration_hours,
                                                        'airtime_minutes' => $call_duration_minutes,
                                                        'plan_days'       => $plan_duration_days,
                                                        'plan_hours'      => $plan_duration_hours,
                                                        'plan_minutes'    => $plan_duration_minutes
                                                    );
                        array_push($plans, $plan_details);
                    } else {
                        $plans[$value->product_type][0] = array(
                                                        'id'              => $value->id,
                                                        'code'            => $value->code,
                                                        'name'            => $value->name,
                                                        'description'     => $value->description,
                                                        'type'            => $value->product_type,
                                                        'nominations'     => $value->status,
                                                        'price'           => $value->price,
                                                        'airtime_days'    => $call_duration_days,
                                                        'airtime_hours'   => $call_duration_hours,
                                                        'airtime_minutes' => $call_duration_minutes,
                                                        'plan_days'       => $plan_duration_days,
                                                        'plan_hours'      => $plan_duration_hours,
                                                        'plan_minutes'    => $plan_duration_minutes
                                                    );
                    }
                }
            }
        } catch (Exception $exc) {
            
        }
        return json_encode($plans);
    }

}
