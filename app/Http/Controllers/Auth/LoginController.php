<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;



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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /////protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
        
        $this->middleware('guest')->except('logout');
    }
    public function redirectTo(){

        // User role
        //$role = Auth::user()->role->name;
        
        $user=auth()->user();
        $role=$user->type;
        // Check user role
        switch ($role) {
            case 'super_admin':
                    return '/super_admin';
                break;
            case 'admin':
                    return '/admin_dashboard';
                break;
                case 'user':
                    return '/home';
                break;
             
            default:
                    return '/login';
                break;
        }
    }

    public function logout()
     {
    Auth::logout();
    Session::flush();
    return redirect('/login');
    }
}