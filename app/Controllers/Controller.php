<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Request;

use Symfony\Component\HttpFoundation\JsonResponse;

class Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->response = new Response;

        Auth::checkAuthHeader($this->request);
    }

    /**
     * @param $content
     * @param int $status
     */
    public function send($content, $status = Response::HTTP_OK)
    {
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            // 'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS',
            'Access-Control-Allow-Headers' => '*',
            // 'Access-Control-Request-Headers' => '*',
            'Access-Control-Allow-Credentials' => 'true'
        ];
        foreach ($headers as $key => $value) {            
            $this
                ->response
                ->headers
                ->set($key, $value);
        }
        $this
            ->response
            ->setContent($content)
            ->setStatusCode($status)
            ->send();
        die();
    }

    /**
     * Send an api response
     * @param $success
     * @param $message
     * @param $data
     */
    public function api($success, $data = null, $message = '', $status = Response::HTTP_OK)
    {
        $response = [
            'success' => $success,
            'message' => $message
        ];
        if($data instanceof LengthAwarePaginator){
            $response += $data;
        }else{
            $response['data'] = $data;
        }
        $this->response->headers->set('Content-Type', 'application/json');
        $this->send(json_encode($response), $status);
    }

    /**
     * Send a successful api response
     * @param $message
     * @param null $data
     */
    public function success($data = null, $message = 'Success!', $status = Response::HTTP_OK)
    {
        $this->api(true, $data, $message, $status);
    }

    /**
     * Send a failed api response
     * @param null $message
     * @param null $data
     */
    public function failed($data = null, $message = 'Failed!', $status = 400)
    {
        $this->api(false, $data, $message, $status);
    }

    public function mustLogin()
    {
        Auth::check() || $this->failed(null, 'You must login to perform this action', 401);
    }
}