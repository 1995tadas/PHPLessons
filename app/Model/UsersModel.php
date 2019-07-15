<?php

namespace App\Model;
use Core\Database;
class UsersModel
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $role_id;
    private $active;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    public  function load($id){
        //return $this->db->select('name')->from('users');
        $this->db->select()->from('table')->where('id', $id);
        $post = $this->db->get();
        $this->id = $post->id;
        $this->name = $post->name;
        $this->surname = $post->surname;
        $this->email = $post->email;
        $this->password = $post->password;
        $this->role_id = $post->role_id;

    }
    public function save($id = null){
        if($id !== null){
            $this->id = $id;
            $this->update();
        } else {
            $this->create();
        }
    }
    public function update(){
        $setContent ="name = '$this->name', surname = '$this->surname',email ='$this->email',password ='$this->password',role_id ='$this->role_id'";
        $this->db->update('user',$setContent)->where('id',$this->id);
        $this->db->get();
    }
    public function create(){
        $tableFields = "name, surname, email, password, role_id";
        $values = "'$this->name','$this->surname','$this->email','$this->password','$this->role_id'";
        $this->db->insert('user', $tableFields, $values);
        return $this->db->get();

    }

    public  static function verification ($email, $password) {
        $db = new Database();
        $db->select()->from('user')->where('email',$email)->andWhere('password',$password);
        return $db->get();
    }



}