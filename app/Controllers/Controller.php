<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        $this
            ->response
            ->setContent($content)
            ->setStatusCode($status)
            ->send();
    }

    /**
     * Send an api response
     * @param $success
     * @param $message
     * @param $data
     */
    public function api($success, $data = null, $message = '')
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
        $this->send(json_encode($response), Response::HTTP_OK);
    }

    /**
     * Send a successful api response
     * @param $message
     * @param null $data
     */
    public function success($data = null, $message = 'Success!')
    {
        $this->api(true, $data, $message);
    }

    /**
     * Send a failed api response
     * @param null $message
     * @param null $data
     */
    public function failed($data = null, $message = 'Failed!')
    {
        $this->api(false, $data, $message);
    }
}