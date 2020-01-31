<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    public function login(Request $request){
        $validator = Validator::make($request->all(),
            [
                'email' => 'bail|required|email',
                'password' => 'bail|required|min:8',
            ],
            [
                'required' => ':attribute Không được để trống',
                'email' => ':attribute không đúng định dạng',
                'min' => ':attribute Không được nhỏ hơn :min ký tự',
            ],
            [
                'email' => 'Email',
                'password' => 'Mật khẩu',
            ]
        );
        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if(Auth::user() == NULL){
            $email = $request->get('email');
            $password = $request->get('password');
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                if(Auth::user()->role == 1 || Auth::user()->role == 2){
                    return redirect()->route('backend.home');
                }elseif(Auth::user()->role == 0){
                    return redirect()->route('frontend.home');
                }else{
                    return $this->sendFailedLoginResponse($request);
                }
            }else{
                return back()->with('error','Email hoặc mật khẩu không chính xác');
            }
        }else{
            return redirect()->route('frontend.home');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('frontend.home');
    }
}
