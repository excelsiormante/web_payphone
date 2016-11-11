<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session, URL;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $subscriber_id = Session::get("subscriber_id");
        
        if ( $this->auth->guest() || $subscriber_id === null ) {
            if ($request->ajax()) {
                return json_encode(array(
                                    "status" => "failed",
                                    "home"   => URL::to('auth/login')
                                    )
                                );
            } else {
                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
    }
}
