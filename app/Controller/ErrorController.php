<?php
namespace App\Controller;
class ErrorController
{
    public function PageNotFound(){
        echo "404";
    }
    public function MethodNotAllowed(){
        echo "405";

    }

}