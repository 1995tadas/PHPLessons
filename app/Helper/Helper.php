<?php

namespace App\Helper;

class  Helper
{
    public  function instanceMaker($controller){

    }
    public function getController($path){

        $controller = strtolower($path);
        $controller = ucfirst($controller);
        $controller = '\App\Controller\\'.$controller.'Controller';
        return $controller;
    }
}
