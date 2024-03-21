<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Agent;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function showRegistrationForm(Request $request)
    {
        Session::put('previous_user_id', auth()->id());

        $role = $request->input('role');
        return view('auth.register', ['role' => $role]);
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
            'role' => ['required', 'string', 'in:Agent,Customer'],
            'phone' => ['required', 'string', 'max:10'], 
            'address' => ['required', 'string', 'max:255'],
        ]);
    }


    public function register(Request $request)
    { 
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $previousUserId = Session::get('previous_user_id');
        auth()->loginUsingId($previousUserId);

        return redirect()->route('home')->with('success', 'User registered successfully');
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        if ($data['role'] === 'Agent') {
            $agent = new Agent();
            $agent->agent_id = $user->id;
            $agent->name = $data['name'];
            $agent->email = $data['email'];
            $agent->phone_no = $data['phone'];
            $agent->address = $data['address'];
            $agent->save();
        }
        elseif ($data['role'] === 'Customer') {
            $customer = new Customer();
            $customer->customer_id = $user->id;
            $customer->name = $data['name'];
            $customer->email = $data['email'];
            $customer->phone_no = $data['phone'];
            $customer->address = $data['address'];
            $customer->save();
        }
        return $user;
    }

}
