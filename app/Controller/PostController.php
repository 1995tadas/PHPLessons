<?php
namespace App\Controller;
use Core\Controller;
$error = new \App\Controller\ErrorController();
class PostController extends Controller
{
    public  function index(){
        $this->view->posts = \App\Model\PostModel::getPosts();
        $this->view->render('posts/posts');
    }
    public  function show($id){
        $postObject = new \App\Model\PostModel();
        $postObject->load($id);
        $this->view->post = $postObject;
        $this->view->render('posts/post');
    }
    public function create() {
        if(currentUser()){
        $this->view->render('posts/admin/create');
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }
    }
    public function redirect($url, $statusCode = 303){
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    public function store(){
        if(currentUser()) {
            $data = $_POST;
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->setTitle($data['title']);
            $postModelObject->setContent($data['content']);
            $postModelObject->setImage($data['image']);
            $postModelObject->setAuthor_id($data['author_id']);
            $postModelObject->save();
            $this->redirect(url('post/'));
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }
    }

    public function edit($id)
    {
        if (currentUser()) {
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->load($id);
            $this->view->post = $postModelObject;
            $this->view->render('posts/admin/edit');
            //$this->redirect(url('post/'));
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }
    }

    public function update(){
        if(currentUser()) {
            $data = $_POST;
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->setTitle($data['title']);
            $postModelObject->setContent($data['content']);
            $postModelObject->setImage($data['image']);
            $postModelObject->setAuthor_id($data['author_id']);
            $postModelObject->save($data['id']);
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();

        }
    }

    public function delete($id) {
        if(currentUser()) {
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->delete($id);
            $this->redirect(url('post/'));
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }

    }
}