<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required||digits:10',
            'address' => 'required|min:10',
            ],
            [
                'required' => ':attribute Không được để trống',
                'email' => ':attribute không đúng định dạng',
                'min' => ':attribute Không được nhỏ hơn :min ký tự',
                'max' => ':attribute Không được vượt quá :max ký tự',
                'digits' => ':attribute phải là số có 10 chữ số',
                'size' => ':attribute phải có 10 chữ số',
                'unique' => ':attribute đã tồn tại',
                'confirmed' => ':attribute nhập lại không chính xác',
            ],
            [
                'name' => 'Họ và tên',
                'email' => 'Email đăng kí',
                'password' => 'Mật khẩu',
                'phone' => 'Số điện thoại',
                'address' => 'Địa chỉ',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'avatar' => 'storage/images/user_avatar/default-avatar.jpg',
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.my_form_register');
    }

}
