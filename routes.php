<?php

use Classes\Route;


Route::set('/', [
    'controller' => 'Home',
    'method' => 'index',
]);

Route::set('/posts', [
    'controller' => 'Post',
    'method' => 'all',
]);

Route::set('/post/edit', [
    'controller' => 'Post',
    'method' => 'edit',
]);

Route::execute();