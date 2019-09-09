<?php
namespace App\Controller;
use App\Helper\FormHelper;
use App\Helper\ImageHelper;
use Core\Controller;
use Intervention\Image\ImageManager;
$error = new \App\Controller\ErrorController();
class PostController extends Controller
{
    public  function index(){
        $this->view->posts = \App\Model\PostModel::getPosts();
        $this->view->render('posts/posts');
        $this->view->posts = \App\Model\PostModel::getPosts();
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
    public function store(){
        if(currentUser()) {
            $data = $_POST;
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->setTitle($data['title']);
            $postModelObject->setContent($data['content']);
            $postModelObject->setImage($data['image']);
            $postModelObject->setAuthor_id($data['author_id']);
            $postModelObject->save();
            redirect(url('post/'));
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
            $selectedCategories = [];
            foreach ($postModelObject->getCategories() as $cat) {
                $selectedCategories[] = $cat->category_id;
            }
            $form = new FormHelper(url('post/update'), 'post','edit-wrapper','enctype="multipart/form-data"');
            $form->addInput([
                'name' => 'title',
                'type' => 'text',
                'value' => $postModelObject->getTitle()
            ],'','block')
                ->addInput([
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $postModelObject->getId()
                ],'','block')
                ->addTextarea([
                    'name' => 'content'
                ], $postModelObject->getContent(),'','block')
                ->addInput([
                    'name' => 'image',
                    'type' => 'file',
                    'value' => $postModelObject->getImage()
                ],'','block');
            $allCategories = \App\Model\CategoriesModel::getCategories();
            foreach ($allCategories as $category){
                if(in_array($category->id, $selectedCategories)) {
                    $form->addInput([
                        'name' => 'category[]',
                        'type' => 'checkbox',
                        'checked' => 'checked',
                        'value' => $category->id,
                    ], $category->name, 'cat');
                }else{
                    $form->addInput([
                        'name' => 'category[]',
                        'type' => 'checkbox',
                        'value' => $category->id,
                    ], $category->name, 'cat');
                }
            }
            $form->tag('h1','','msg')->addInput([
                'name' => 'submit',
                'type' => 'submit',
                'value' => 'ok'
            ]);
            $this->view->form = $form->get();

            $postModelObject->load($id);
            $this->view->post = $postModelObject;
            $this->view->render('posts/admin/edit');
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }
    }

    public function update(){
        if(currentUser()) {

            $imageObject= new ImageHelper();
            $imageObject->upload();
            $response =[];

            $postModelObject = new \App\Model\PostModel();
            $postModelObject->load($_POST['id']);
            $postModelObject->setTitle($_POST['title']);
            $postModelObject->setContent($_POST['content']);
            $postModelObject->setImage($_FILES["image"]["name"]);
            //$postModelObject->setAuthor_id($data[1]);
            $postModelObject->save();
            $postModelObject->setCategories($_POST['category']);

            $response['msg']="POST saved";
            $response{'code'} = 200;
            echo json_encode($response);


           // redirect(url('post/'));
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();

        }
    }

    public function delete($id) {
        if(currentUser()) {
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->delete($id);
            redirect(url('post/'));
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }

    }
}