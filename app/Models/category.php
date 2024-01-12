<?php

require_once 'database.php';

class category {

    private $categoryId;
    private $categoryName;

    private $db;

    public function __construct() {
        $this->db = DATABASE::getconnection();
    }

    public function __get ($param) {
        return $this->$param;
    }

    public function __set($param , $value) {
        $this->$param = $value;
    }

    public function get_all_categorys () {
        $get = $this->db->query("SELECT * FROM category");
        $result = $get->fetchAll(PDO::FETCH_ASSOC);
        $categorys = [];
        foreach($result as $row) {
            $category = new category;
            $category->__set('categoryId',$row['categoryId']);
            $category->__set('categoryName' , $row['categoryName']);
            $categorys [] = $category;
        }
        return $categorys;
    }

    public function categoryStats () {
        $get = $this->db->query('SELECT COUNT(categoryId) FROM category');
        $result = $get->fetch(PDO::FETCH_COLUMN);
        return $result;
    }


    public function get_category_by_name () {
        $get = $this->db->prepare("SELECT * FROM category WHERE categoryId = :id");
        $get->bindValue(':id' , $this->__get('categoryId') , PDO::PARAM_INT);
        $get->execute();
        $result = $get->fetch(PDO::FETCH_ASSOC);
        $this->__set('categoryId' , $result['categoryId']);
        $this->__set('categoryName' , $result['categoryName']);
    }


    public function delete_category() {
        $categoryId = $this->__get('categoryId');
        $delete = $this->db->prepare('DELETE FROM category WHERE categoryId = :id');
        $delete->bindValue(':id' , $categoryId , PDO::PARAM_INT);
        $delete->execute();
    }


    public function modify_category() {
        $modify = $this->db->prepare('UPDATE category SET categoryName = :name WHERE categoryId = :id');
        $modify->bindValue(':id' , $this->__get('categoryId') , PDO::PARAM_INT);
        $modify->bindValue(':name' , $this->__get('categoryName'),PDO::PARAM_STR);
        $modify->execute();
    }

    public function insertCategory() {
        $insert = $this->db->prepare('INSERT INTO category (categoryName) VALUES (:CT)');
        $insert->bindValue(':CT',$this->__get('categoryName') , PDO::PARAM_STR);
        $insert->execute();
    }




    public function latest_category() {
        $latest = $this->db->query('SELECT * FROM category ORDER BY categoryId DESC LIMIT 10');
        $result = $latest->fetchAll(PDO::FETCH_ASSOC);
        $categorys = [];

        foreach($result as $row) {
            $category = new category();
            $category->__set('categoryId' , $row['categoryId']);
            $category->__set('categoryName' , $row['categoryName']);
            $categorys [] = $category;
        }

        return $categorys;
    }
}

