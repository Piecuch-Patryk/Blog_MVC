<?php

use Classes\Route;

$route = new Route();

$route->set('/', [
    'controller' => 'Home',
    'method' => 'index',
]);
$route->set('/posts', [
    'controller' => 'Post',
    'method' => 'all',
]);
// $route->set('/about');




$route->execute();