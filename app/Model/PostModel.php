<?php
namespace App\Model;
use Core\Database;
class PostModel {
    //parametrai
    private $id = null;
    private $title;
    private $content;
    private $image;
    private $author_id;
    private $date;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getId(){
        return $this->id;
    }
    public function setTitle($title){
        $this->title=$title;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setContent($content){
        $this->content=$content;
    }
    public function getContent(){
        return $this->content;
    }
    public function setImage($image){
        $this->image=$image;
    }
    public function getImage(){
        return $this->image;
    }
    public function setAuthor_id($author_id){
        $this->author_id=$author_id;
    }
    public function getAuthor_id(){
        return $this->author_id;
    }
    public function getDate(){
        return $this->date;
    }

    public static function getPosts(){
        $db = new Database();
        $db->select()->from("`post`")->where('active',1);
        return  $db->getAll();
    }

    public  function load($id)
    {
        //return $this->db->select('name')->from('users');
        $this->db->select()->from('post')->where('id', $id);
        $post = $this->db->get();
        $this->id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->image = $post->image;
        $this->author_id = $post->author_id;
        $this->date = $post->date;

    }
    public function save($id = null)
    {
        if($id !== null){
            $this->id = $id;
            $this->update();
        } else {
            $this->create();
        }
    }
    public function update(){
        $setContent ="title = '$this->title', content = '$this->content',author_id = '$this->author_id',image ='$this->image'";
        $this->db->update('post',$setContent)->where('id',$this->id);
        $this->db->get();
    }
    public function create(){
        $tableFields = "title, content, author_id, image";
        $values = "'$this->title','$this->content','$this->author_id','$this->image'";
        $this->db = new Database();
        $this->db->insert('post', $tableFields, $values);
        return $this->db->get();
    }

    public  function  delete($id) {
        $setContent = "active = 0";
        $this->db->update('post',$setContent)->where('id',$id);
        $this->db->get();
    }
}