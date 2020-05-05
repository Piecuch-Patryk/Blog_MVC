<?php

/**
 * Config
 */
require __DIR__ . '/config.php';


/**
 * Autoloader
 */
require __DIR__ . '/Classes/Autoloader.php';
Autoloader::register();


/**
 * Router
 */
require __DIR__ . '/Classes/Router.php';
$app = new Router();