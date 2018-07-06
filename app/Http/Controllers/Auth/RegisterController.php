<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Http\Request;
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
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
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function register(Request $request)
    {
        $inputs = $request->all();
        $validator = $this->validator($inputs);
        $validator->validate();
        if($validator->passes())
        {
            $data = $this->create($inputs)->toArray();
            $data['token'] = str_random(25);
            $user = User::find($data['id']);
            $user->token = $data['token'];
            $user->save();
            Mail::send('client-side.confirmation',$data,function($message) use ($data) {
                 $message->to($data['email']);
                 $message->subject('Registration Confirmation');
            });
            return response()->json(['status' => 'success','message' => 'confirmation link has been sent to your email please check it out.']);
        }
        else
        {
            return response()->json(['status' => 'failed','message' => 'Something went wrong.']);
        }
        return response()->json(['status' => 'failed','errors' => $validator->errors()]);
    }   

    protected function confirmToken($token)
    {
        $user = User::where('token',$token)->first();
        if(!is_null($user))
        {
            $user->confirmed = 1;
            $user->token = '';
            $user->save();
            return Auth::login($user);
        }
        return back()->with('status,','Something went wrong.');
    }
}
