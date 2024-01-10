<?php
require_once 'database.php';
class wikis {

    private $wikiId;
    private $wikiTitle;
    private $wikiText;
    private $categoryId;
    private $userId;
    private $wikiStatus;

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

    public function wikiStats () {
        $get = $this->db->query('SELECT COUNT(wikiId) FROM wiki');
        $result = $get->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

        public function get_all_wikis () {
            $get = $this->db->query("SELECT * FROM wiki");
            $result = $get->fetchAll(PDO::FETCH_ASSOC);
            $wikis = [];
            foreach($result as $row) {
                $wiki = new wikis();
                $wiki->__set('wikiId' , $row['wikiId']);
                $wiki->__set('wikiTitle' , $row['wikiTitle']);
                $wiki->__set('wikiText' , $row['wikitext']);
                $wiki->__set('categoryId' , $row['categoryId']);
                $wiki->__set('userId' , $row['userId']);
                $wiki->__set('wikiStatus' , $row['wikiStatus']);
                $wikis [] = $wiki;
            }

            return $wikis;
        }


        public function change_status() {
            $check = $this->db->prepare('SELECT wikiStatus FROM wiki WHERE wikiId = :id');
            $check->bindValue(':id' , $this->__get('wikiId'),PDO::PARAM_INT);
            $check->execute();
            $result = $check->fetch(PDO::FETCH_ASSOC);
            if($result['wikiStatus'] == 'active'){
                $update = $this->db->prepare('UPDATE wiki SET wikiStatus = "archived" WHERE wikiId = :id');
            }
            else{
                $update = $this->db->prepare('UPDATE wiki SET wikiStatus = "active" WHERE wikiId = :id');
            }

            $update->bindValue(':id' , $this->__get('wikiId'),PDO::PARAM_INT);
            $update->execute();

        }


        public function delete_wiki() {
            $delete = $this->db->prepare('DELETE FROM wiki WHERE categoryId = :id');
            $delete->bindValue(':id' , $this->__get('categoryId') , PDO::PARAM_INT);
            $delete->execute();
        }
}