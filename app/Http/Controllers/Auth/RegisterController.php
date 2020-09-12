<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\stripeHelper;
use App\Http\Controllers\Controller;
use App\Mail\SignupMail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

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

    public function showRegistrationForm(Request $request)
    {

        if($request->get('plan'))
        {
            Cookie::queue('plan',$request->get('plan'));
        }

        return view('auth.register');
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
            'adresse' => ['required','min:20'],
            'country' => ['required'],
            'provice' => ['required'],
            'postal_code' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required',
            'last_name' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
           $user =  User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'adresse' => $data['adresse'],
                'country' => $data['country'],
                'province' => $data['province'],
                'postal_code' => $data['postal_code'],
                'password' => Hash::make($data['password']),
               'last_name' => $data['last_name'],
               'phone' => $data['phone'],
            ]);

            $user->assignRole('client');
            $user->assignRole('frontoffice');

            $stripe = new stripeHelper();

            $user = $stripe->addCustomer($user);

        Mail::to($user->email)->send(new SignupMail($user));
        return $user;
    }
}
