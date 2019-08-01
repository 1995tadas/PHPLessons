<?php


namespace App\Model;

use Core\Database;


class CategoriesModel
{
    private $id;
    private $name;
    private $description;
    private $parentId;
    private $slug;
    private $active;

    /**
     * @return mixed
     */

    public  function __construct()
    {
        $this->db = new Database();
    }

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
    public static function getCategories(){
        $db = new Database();
        $db->select()->from("`categories`")->where('active',1);
        return  $db->getAll();
    }
    public static function getParentCategories(){
        $db = new Database();
        $db->select()->from('categories')
            ->where('parent_id',0)
            ->andWhere('active',1);
        return $db->getAll();
    }
    public function save()
    {
        if($this->id){
            $this->update();
        }else{
            $this->create();
        }
    }
    public function update(){
        $setContent ="name = '$this->name', description = '$this->description',parent_id = '$this->parentId',slug ='$this->slug'";
        $this->db->update('categories',$setContent)->where('id',$this->id);
        $this->db->get();
    }
    public function create(){
        $tableFields = "name, description, parent_id, slug";
        $values = "'$this->name','$this->description','$this->parentId','$this->slug'";
        $this->db = new Database();
        $this->db->insert('categories', $tableFields, $values);
        return $this->db->get();
    }

    public function delete($id){
        $setContent = "active = 0";
        $this->db->update('categories',$setContent)->where('id',$id);
        $this->db->get();

    }
    public function load($id){
        $this->db->select()->from('categories')->where('id', $id);
        $category=$this->db->get();
        $this->id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->parentId = $category->parent_id;
        $this->slug = $category->slug;
        return $this;
    }

    public function loadBySlug($slug){
        $this->db->select()->from('categories')->where('slug', $slug);
        $category = $this->db->get();
        $this->load($category->id);
    }
    public function getPosts(){
        $this->db->select('post_id')->from('category_posts')->where('category_id',$this->id);
        return $this->db->getAll();
    }

}