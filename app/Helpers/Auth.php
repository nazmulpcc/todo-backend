<?php


namespace App\Helpers;


use App\Models\User;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;

class Auth
{
    protected static $user;

    /**
     * Get the logged in user
     * @return User
     */
    public static function user()
    {
        return static::$user;
    }
    /**
     * Login via username and password
     * @param $username
     * @param $password
     * @param string $key
     * @return bool
     */
    public static function login($username, $password, $key = 'email')
    {
        $user = User::where($key, $username)->first();
        if($user && password_verify($password, $user->password)){
            static::$user = $user;
            return true;
        }
        return false;
    }

    /**
     * Check the given request for bearer token
     * If exists, login the user
     * @param $request Request
     */
    public static function checkAuthHeader($request)
    {
        // check for a token and try to login
        if($token = $request->headers->get('authorization')){
            list($none, $token) = explode(' ', $token);
            try {
                $decoded = (array) JWT::decode($token, config('app.jwt'), array('HS256'));
                // if the decoded token is still valid, login the user
                if($decoded['valid_till'] >= time()){
                    static::$user = User::find($decoded['id']);
                }
            }catch (\Exception $e){
                //
            }
        }
    }

    /**
     * Check if a user is logged in
     * @return bool
     */
    public static function check()
    {
        return !! static::$user;
    }

    /**
     * Login via username and generate a jwt response data
     * @param $username
     * @param $password
     * @param string $key
     * @return array|bool
     */
    public static function jwt($username, $password, $key = 'email')
    {
        if(Auth::login($username, $password, $key)){
            $data = static::$user->only('id') + [
                'valid_till' => time() + 3600 * config('app.jwt_validity') // 1 month from now
            ];
            $token = JWT::encode($data, config('app.jwt'));
            return [
                'token' => $token,
                'valid_till' => $data['valid_till']
            ];
        }
        return false;
    }
}