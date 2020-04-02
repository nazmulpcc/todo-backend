<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new \Bramus\Router\Router();

$router->setNamespace('App\Controllers');

$router->get('/', 'HomeController@index');

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/me', 'AuthController@me');

return $router;