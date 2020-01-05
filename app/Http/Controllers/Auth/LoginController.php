<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        //return view('auth.login');
        return view('auth.my_form_login');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 2])) {
             return redirect()->route('backend.home');
        }elseif(Auth::attempt(['email' => $email, 'password' => $password, 'role' => [0,1]])){
            return redirect()->route('frontend.home');
        }else{
            return $this->sendFailedLoginResponse($request);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('frontend.home');
    }
}
