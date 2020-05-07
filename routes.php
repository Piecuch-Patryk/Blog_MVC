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

// Dashboard - store created user
Route::set('/user/store', [
    'controller' => 'User',
    'method' => 'store',
]);

// Dashboard - show all users
Route::set('/dashboard/users', [
    'controller' => 'User',
    'method' => 'showAll',
]);

// Dashboard - edit user
Route::set('/user/edit', [
    'controller' => 'User',
    'method' => 'edit',
]);

// Dashboard - delete user
Route::set('/user/delete', [
    'controller' => 'User',
    'method' => 'delete',
]);

// Posts
Route::set('/posts', [
    'controller' => 'Post',
    'method' => 'showAll',
]);

// Post - edit
Route::set('/post/edit', [
    'controller' => 'Post',
    'method' => 'edit',
]);

// Registers defined routes. 
Route::execute();