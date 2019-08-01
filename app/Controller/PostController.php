<?php
namespace App\Controller;
use App\Helper\FormHelper;
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
            $targetDirectory = "/var/www/html/mvc/uploads/";
            $target_file = $targetDirectory . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
// Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            //image800x600.jpg i/m/a image.jpg

            $manager = new ImageManager(array('driver' => 'imagick'));
            $image = $manager->make($target_file)->resize(300, 200);
            $image->save('/var/www/html/mvc/uploads/300x200'.$_FILES["image"]["name"],'60');

            $data = $_POST;
            $response =[];

            $postModelObject = new \App\Model\PostModel();
            $postModelObject->load($data['id']);
            $postModelObject->setTitle($data['title']);
            $postModelObject->setContent($data['content']);
            $postModelObject->setImage($_FILES["image"]["name"]);
            //$postModelObject->setAuthor_id($data[1]);
            $postModelObject->save();
            $postModelObject->setCategories($data['category']);

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