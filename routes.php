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

// Dashboard - create new user
Route::set('/dashboard/create-user', [
    'controller' => 'Dashboard',
    'method' => 'createUser',
]);
Route::set('/user/store', [
    'controller' => 'User',
    'method' => 'store',
]);

// Dashboard - show all users
Route::set('/dashboard/users', [
    'controller' => 'User',
    'method' => 'showAll',
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