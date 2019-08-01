<?php


namespace App\Controller;

use Core\Controller;
use \App\Helper\InputHelper;
use \App\Helper\FormHelper;


class AccountController extends Controller
{

    public function index()
    {
        echo 'ok';
    }

    public function registration()
    {
        $form = new FormHelper(url('account/create'),'post', 'registration-wrapper');
        $form->tag('h1','Sign up')
            ->addInput([
            'name' => 'name',
            'placeholder' => 'Name',
            'type' => 'text',
            'required' =>'required',
        ])
            ->addInput([
                'name' => 'surname',
                'placeholder' => 'Surname',
                'type' => 'text',
                'required' =>'required',

            ])
            ->addInput([
                'name' => 'email',
                'placeholder' => 'Email',
                'type' => 'email',
                'required' =>'required',
                'class'=>'email'

            ])->addInput([
                'name' => 'password',
                'placeholder' => 'Password',
                'type' => 'password',
                'required' =>'required',
                'class' =>'password',

            ])->addInput([
                'name' => 'password2',
                'placeholder' => 'Repeat your password',
                'type' => 'password',
                'required' =>'required',
                'class'=>'password2',

            ])->tag('p','','msg-registration')
            ->addInput([
                'name' => 'submit',
                'value' => 'Submit',
                'type' => 'submit',

            ]);

        $this->view->form =  $form->get();
        $this->view->render('posts/account/registration');
        //laudinsim registracijos forma
    }

    public function login()
    {
        $form = new FormHelper(url('account/auth'),'post', 'login-wrapper');
        $form->tag('h1','Log in')
            ->addInput([
                'name' => 'email',
                'placeholder' => 'Email',
                'type' => 'email',
                'required' =>'required',
            ])->addInput([
                'name' => 'password',
                'placeholder' => 'Password',
                'type' => 'password',
                'required' =>'required',
            ])->addInput([
                'name' => 'submit',
                'value' => 'Submit',
                'type' => 'submit',
            ]);
           $this->view->form =  $form->get();

        $this->view->render('posts/account/login');
        //laudinsim logino forma
    }



    public function create()
    {
        if (InputHelper::checkEmail($_POST['email'])) {
            if (InputHelper::passwordMatch($_POST['password'], $_POST['password2'])){
            $accountModelObject = new \App\Model\UsersModel();
            $accountModelObject->setName($_POST['name']);
            $accountModelObject->setSurname($_POST['surname']);
            $accountModelObject->setEmail($_POST['email']);
            $pass = \App\Helper\InputHelper::passwordGenerator($_POST['password']);
            $accountModelObject->setPassword($pass);
            $accountModelObject->setRoleId(1);
            $accountModelObject->save();
            redirect(url('account/login/'));
        }
        }
    }

    public function auth()
    {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $pass = \App\Helper\InputHelper::passwordGenerator($password);
        $user = \App\Model\UsersModel::verification($email, $pass);
        if (!empty($user)) {
            $_SESSION{'user'}=$user;
            redirect(url('post/'));
            //prisiloginus
            //redirectas i admin
        } else {
            echo "Incorect Email or password";
            //neteisingas prisijungimas
            //redirectas i logina
        }
    }

    public function emailverification (){
        $response = [];

        if(!InputHelper::uniqEmail($_POST['email_ajax'])){
            $response['code'] = 200;
        } else {
            $response['code'] = 500;
        }

        echo json_encode($response);
}
    public function logout(){
        session_destroy();
        redirect(url('post/'));
    }
}