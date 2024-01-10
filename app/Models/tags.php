<?php

require_once 'database.php';
class tags {

    private $tagId;

    private $tagName;

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

    public function tagStats () {
        $get = $this->db->query('SELECT COUNT(tagId) FROM tag');
        $result = $get->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    public function get_all_tags() {
    $query = $this->db->query('SELECT * FROM tag');
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $tags = [];

    foreach($result as $row){
        $tag = new tags();
        $tag->__set('tagId' , $row['tagId']);
        $tag->__set('tagName' , $row['tagName']);
        $tags [] = $tag;
    }

    return $tags;
}


public function insert_tag() {
    $query = $this->db->prepare('INSERT INTO tag (tagName) VALUES (:tagName)');
    $query->bindParam(':tagName', $this->tagName, PDO::PARAM_STR);
    $query->execute();
}


public function modify_tag() {
    $modify = $this->db->prepare('UPDATE tag SET tagName = :name WHERE tagId = :id');
    $modify->bindValue(':id' , $this->__get('tagId') , PDO::PARAM_INT);
    $modify->bindValue(':name' , $this->__get('tagName'),PDO::PARAM_STR);
    $modify->execute();
}

public function delete_tag() {
        $tagId = $this->__get('tagId');
        $deletefromwikitag = $this->db->prepare('DELETE FROM wikitag WHERE tagId = :id');
        $delete = $this->db->prepare('DELETE FROM tag WHERE tagId = :id');
        $delete->bindValue(':id' , $tagId , PDO::PARAM_INT);
        $deletefromwikitag->bindValue(':id' , $tagId , PDO::PARAM_INT);
        $deletefromwikitag->execute();
        $delete->execute();
}

}