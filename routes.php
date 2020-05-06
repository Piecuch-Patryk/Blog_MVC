<?php

use Classes\Route;

// Home
Route::set('/', [
    'controller' => 'Home',
    'method' => 'index',
]);

// Login form
Route::set('/login', [
    'controller' => 'User',
    'method' => 'index',
]);

// Login action
Route::set('/user/login', [
    'controller' => 'User',
    'method' => 'login',
]);

// Logout action
Route::set('/user/logout', [
    'controller' => 'User',
    'method' => 'logout',
]);

// Dashboard
Route::set('/dashboard', [
    'controller' => 'Dashboard',
    'method' => 'index',
]);

Route::set('/posts', [
    'controller' => 'Post',
    'method' => 'showAll',
]);

Route::set('/post/edit', [
    'controller' => 'Post',
    'method' => 'edit',
]);

Route::execute();