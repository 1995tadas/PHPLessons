<?php
function url($path, $param = 0){
    $url = 'http://141.136.44.119/mvc/index.php/'.$path;
    if($param !== 0){
        $url .= '/'.$param;
    }
    return $url;

}

function uploadsUrl($path){
    $url = 'http://141.136.44.119/mvc/uploads/'.$path;
    return $url;
}
function currentUser(){
    if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    } else {
        return 0;
    }
}
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function debug($data) {
    echo '<pre>';
    print_r($data);
    die();
}

function getGeneratedImage($image,$width,$height)
{
    return App\Helper\ImageHelper::generate($image,$width,$height);

}
