<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user  = "";
        event(new Registered($user = $this->create($request->all())));

        $createUser = $this->createUserOnCometChat($user);

        if ($createUser) {
            $this->updateToken($user->email, json_decode($createUser->body())->data->authToken);

            return response()->json([
                'user' => $user,
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function createUserOnCometChat($user)
    {
        $body = [
            "uid" => str_replace(' ', '', $user->name),
            "name" => $user->name,
        ];
        try {

            Http::withHeaders([
                'appId' =>  env('MIX_COMMETCHAT_APP_ID'),
                'apiKey' => env('MIX_COMMETCHAT_REST_API_KEY'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])
                ->withBody(json_encode($body), 'application/json')
                ->post('https://api-us.cometchat.io/v2.0/users');



            return Http::withHeaders([
                'appId' =>  env('MIX_COMMETCHAT_APP_ID'),
                'apiKey' => env('MIX_COMMETCHAT_REST_API_KEY'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])
                ->post('https://api-us.cometchat.io/v2.0/users/'.$body['uid'].'/auth_tokens');

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function updateToken($email, $token) {
        return User::where('email', $email)->update([
            'token' => $token
        ]);
    }
}
