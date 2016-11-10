<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Auth, Input, Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB, Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    private $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }


     /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        if (Auth::attempt(['email_address' => $email, 'password' => $password])) {
            // Authentication passed...

            $user = Auth::user();

            Session::put('id', $user->id);
            Session::put('name', $user->name);
            Session::put('email', $user->email_address);

            return redirect()->intended('/');
        }
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
         return Validator::make($data, [
            'firstname'  => 'required|max:255',
            'middlename' => 'required|max:255',
            'lastname'   => 'required|max:255',
            'email'      => 'required|email|max:255',
            'subs_type'  => 'required|max:255',
            'bday'       => 'required|max:255|date',
            'address'    => 'required|max:255',
            'city'       => 'required|max:255',
            'state'      => 'required|max:255',
            'postal'     => 'required|max:255',
            'country'    => 'required|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $query = "SELECT pgc_halo.fn_register_subscriber(?,?,?,?,?,?,?,?,?,?,?,?);";
        $bindings = array(
                        $data['firstname'], 
                        $data['middlename'], 
                        $data['lastname'], 
                        $data['email'], 
                        $data['subs_type'], 
                        $data['bday'], 
                        $data['_token'], 
                        $data['address'], 
                        $data['city'], 
                        $data['state'], 
                        $data['postal'], 
                        $data['country']);
        
        DB::select($query, $bindings);
        
        // EMAIL
        Session::put('with_reg', true);
    }
}
