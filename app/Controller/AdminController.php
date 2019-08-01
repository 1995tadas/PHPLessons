<?php


namespace App\Controller;


use App\Model\CategoriesModel;
use App\Model\PostModel;
use Core\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if(currentUser() === 0 ){
            //redirect
            header('Location:'.url('account/login'));
            die();
        }
        $roleid = (int)currentUser()->role_id;
        if($roleid !== 2){
            header('Location:'.url('account/login'));
        }
    }

    public function posts()
    {
        $posts = PostModel::getPosts();
        $this->view->posts = $posts;
        $this->view->renderAdmin('posts/admin/posts');

    }
    public  function categories(){
        $categories = \App\Model\CategoriesModel::getCategories();
        $this->view->categories = $categories;
        $this->view->renderAdmin('admin/categories');

    }
}