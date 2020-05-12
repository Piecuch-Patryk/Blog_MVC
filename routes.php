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
// Dashboard - update edited user
Route::set('/user/update', [
    'controller' => 'User',
    'method' => 'update',
]);

// Dashboard - delete user
Route::set('/user/delete', [
    'controller' => 'User',
    'method' => 'delete',
]);

// Dashboard - my posts
Route::set('/dashboard/posts', [
    'controller' => 'Dashboard',
    'method' => 'posts',
]);

// Posts
Route::set('/posts', [
    'controller' => 'Post',
    'method' => 'showAll',
]);

// Post - create
Route::set('/post/create', [
    'controller' => 'Post',
    'method' => 'create',
]);

// Post - store
Route::set('/post/store', [
    'controller' => 'Post',
    'method' => 'store',
]);

// Post - delete
Route::set('/post/delete', [
    'controller' => 'Post',
    'method' => 'destroy',
]);

// Post - edit
Route::set('/post/edit', [
    'controller' => 'Post',
    'method' => 'edit',
]);

// Post - update
Route::set('/post/update', [
    'controller' => 'Post',
    'method' => 'update',
]);

// Registers defined routes. 
Route::execute();