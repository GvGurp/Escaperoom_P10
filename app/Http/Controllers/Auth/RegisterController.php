<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    protected function redirectPath()
{
    // Controleer de rol van de gebruiker
    if (auth()->user()->role === 'admin') {
        return 'admin/admin_home'; // Route of URL voor admin
    }

    return 'player/player_home'; // Route of URL voor gewone gebruikers
}
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
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'phonenumber' => ['required', 'string', 'max:15'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'username' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'in:user,admin'], // Alleen "user" of "admin" toegestaan
        'adminCode' => ['nullable', 'string', function ($attribute, $value, $fail) use ($data) {
            if ($data['role'] === 'admin' && $value !== '2005') {
                $fail('The admin code is incorrect.');
            }
        }],
    ]);
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phonenumber' => $data['phonenumber'],
            'email' => $data['email'],
            'username' =>$data['username'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'], // Rol wordt opgeslagen
        ]);
    }
}