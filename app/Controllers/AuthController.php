<?php


namespace App\Controllers;


use App\Helpers\Auth;
use App\Models\User;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register()
    {
        $data = [
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'password' => password_hash($this->request->get('password'), PASSWORD_DEFAULT)
        ];

        $user = User::create($data);

        $this->success(
            $user->toArray(),
            'Account Created'
        );
    }

    /**
     * Login a user
     */
    public function login()
    {
        $email = $this->request->get('email');
        $password = $this->request->get('password');
        if($token = Auth::jwt($email, $password)){
            $this->success(
                $token,
                "Login Successful",
            );
        }else{
            $this->failed(
                null,
                "Please check your username or password"
            );
        }
    }

    public function me()
    {
        if(Auth::check()){
            $this->success(Auth::user()->toArray());
        }else{
            $this->failed();
        }
    }
}