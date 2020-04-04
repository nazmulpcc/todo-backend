<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new \Bramus\Router\Router();

$router->setNamespace('App\Controllers');

$router->get('/', 'HomeController@index');
$router->options('.*', 'HomeController@cors');

// Auth Routes
$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/me', 'AuthController@me');

$router->get('/task', 'TaskController@index');
$router->post('/task', 'TaskController@store');
$router->post('/task/clear', 'TaskController@clear');
$router->post('/task/{task}', 'TaskController@update');

return $router;