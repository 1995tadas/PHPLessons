<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/vendor/autoload.php';

use \App\Helper\Helper;

echo '<pre>';
if(isset($_SERVER['PATH_INFO'])){
    $patch = $_SERVER ['PATH_INFO'];
} else {
    $patch = "/";
}
$patch = explode('/',$patch);
$helper = new Helper();
if(isset($patch[1]) && !empty($patch[1])){
    $controller = $helper->getController($patch[1]);

    if(isset($patch[2]) && !empty($patch[2])){
        $method = $patch[2];
        //echo $method;
    } else {
        $method = 'index';
    }
    if(class_exists($controller)) {
        $object = new $controller;

        if(method_exists($object,$method)){
            $object->{$method}();
        } else {
            $error = new \App\Controller\ErrorController();
            $error->MethodNotAllowed();
        }
    } else {
        $error = new \App\Controller\ErrorController();
        $error ->PageNotFound();
    }
} else {
    $object = new \App\Controller\HomeController();
}

