<?php


namespace App\Controllers;

use Medz\Cors\Cors;

class HomeController extends Controller
{
    public function index()
    {
        $this->success();
    }

    public function cors()
    {
        $this->send(null);
    }
}