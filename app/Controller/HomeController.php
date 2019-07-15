<?php
namespace App\Controller;
use Core\Controller;

class HomeController extends Controller
{
    public function index(){
        $this->view->render('pageParts/home');
    }
}