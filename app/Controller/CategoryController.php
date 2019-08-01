<?php


namespace App\Controller;
use App\Helper\FormHelper;
use App\Helper\InputHelper;
use App\Model\CategoriesModel;
use App\Model\PostModel;
use Core\Controller;


class CategoryController extends Controller
{
    public function index()
    {
        echo "Everything works";
    }

    public function create()
    {
        if(currentUser()) {
            $categories = CategoriesModel::getCategories();
            $options = [0 => 'Pasirinkti parent kategorija'];
            foreach ($categories as $category) {
                $options[$category->id] = $category->name;
            }
            $form = new FormHelper(url('category/store'), 'post', 'form-wrapper');
            $form->tag('h1', 'Category')
                ->addInput([
                    'name' => 'name',
                    'type' => 'text',
                    'placeholder' => 'Category Name',

                ])
                ->addInput([
                    'name' => 'description',
                    'type' => 'text',
                    'placeholder' => 'Description',
                ])
                ->addSelect($options, 'parent_id')
                ->addInput([
                    'name' => 'submit',
                    'type' => 'submit',
                    'value' => 'Submit',
                ]);
            $this->view->form = $form->get();
            $this->view->render('category/create');
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }
    }

    public function edit($id){
        if(currentUser()) {
        $categoryObjectModel = new CategoriesModel();
        $categoryObjectModel->load($id);
        $categories = CategoriesModel::getCategories();

        $options = [0 => 'Pasirinkti parent kategorija'];
        foreach ($categories as $category) {
            $options[$category->id] = $category->name;
        }
        $form = new FormHelper(url('category/store'), 'post','form-wrapper');
        $form->tag('h1','Category')
            ->addInput([
                'name' => 'name',
                'type' => 'text',
                'placeholder' => 'Category Name',
                'value'=>  $categoryObjectModel->getName(),
            ])
            ->addInput([
                'name' => 'description',
                'type' => 'text',
                'placeholder' => 'Description',
                'value'=>  $categoryObjectModel->getDescription(),
            ])
            ->addSelect($options, 'parent_id')
            ->addInput([
                'name' =>'id',
                'type' =>'hidden',
                'value' => $categoryObjectModel->getId(),])
            ->addInput([
                'name' =>'submit',
                'type' =>'submit',
                'value' => 'Submit',
            ]);
        $this->view->form = $form->get();
        $this->view->render('category/edit');
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }
    }

    public function store()
    {
        $helper = new InputHelper();
        $slug = $helper->makeSlug($_POST['name']);
        $categoryModel = new CategoriesModel();
        $categoryModel->setName($_POST['name']);
        $categoryModel->setDescription($_POST['description']);
        $categoryModel->setParentId($_POST['parent_id']);
        $categoryModel->setSlug($slug);
        $categoryModel->save();
    }

    public function delete($id) {
        if(currentUser()) {
            $postModelObject = new CategoriesModel();
            $postModelObject->delete($id);
            redirect(url('admin/categories/'));
        } else {
            $error = new \App\Controller\ErrorController();
            $error ->PageNotFound();
        }

    }
    public function show($slug)
    {
        $category = new CategoriesModel();
        $category->loadBySlug($slug);
        $posts=[];
        foreach ($category->getPosts() as $post){
            $postObject = new PostModel();
            $postObject->load($post->post_id);
            if($postObject->getActive()==1){
                $posts[] = $postObject;
            }

        }
        $this->view->categoryName=$category->getName();
        $this->view->posts = $posts;
        $this->view->render('category/view');

    }
}

