<?php
namespace Core;
use Core\View;

class Controller
{
    protected $view;
    public function  __construct()
    {
        $this->view = new View();
        $this->view->user = currentUser();
    }
}
