<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator, Crypt;
use Auth, Input, Session, Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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

    private $redirectTo = 'app';

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

            Session::put('subscriber_id', Crypt::encrypt($user->id));
            Session::put('name', $user->name);
            Session::put('email', $user->email_address);
            Session::put('archer_account_id',$user->archer_account_id);

            return redirect()->intended('app');
        } else {
            return redirect('auth/login');
        }
    }

    public function getLogout(){
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
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
            'name'          => 'required|max:255',
            'email_address' => 'required|email|max:255|unique:TBL_SUBSCRIBERS',
            'password'      => 'required|confirmed|min:6'
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
        return User::create([
            'name'          => $data['name'],
            'email_address' => $data['email_address'],
            'password'      => bcrypt($data['password'])
        ]);
    }
}
