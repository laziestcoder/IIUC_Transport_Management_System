<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Bestmomo\LaravelEmailConfirmation\Traits\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers as AuthenticatesUsersBase;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;// AuthenticatesUsersBase;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    // Automatic login prevent

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    // protected function validateLogin(Request $request)
    //     {
    //         $this->validate($request,
    //             [
    //                 $this->username() =>
    //                 [
    //                     'required','string',
    //                     Rule::exists('users')->where(function($query){
    //                         $query->where('confirmation',true);
    //                     })
    //                 ],
    //                 'password' => 'required|string',
    //                 'g-recaptcha-response' => 'required|recaptcha',
    //             ], $this->validationError());
    //      }
    /**
     * Get the validation error for login
     *
     * @return array
     */

    //  public function validationError()
    // {
    //     return [
    //             $this->username().'.exists' =>'Invalid email or activate your acount first!'
    //     ];

    // } 
    protected function validateLogin($request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }


}
