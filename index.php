<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<pre>';
if(isset($_SERVER['PATH_INFO'])){
    $patch = $_SERVER ['PATH_INFO'];
} else {
    $patch = "/";
}
$patch = explode('/',$patch);
if(isset($patch[1]) && !empty($patch[1])){
    $controller = $patch[1];
    echo $controller;
    if(isset($patch[2]) && !empty($patch[2])){
        $method = $patch[2];
        echo $method;
    } else {
        $method = 'index';
    }
} else {
    echo 'Home page';
}