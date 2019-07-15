<?php
function url($path){
    return 'http://141.136.44.119/mvc/index.php/'.$path;
}
function currentUser(){
    if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    } else {
        return 0;
    }
}
