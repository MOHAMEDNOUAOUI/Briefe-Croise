<?php
require_once 'database.php';
class wikis {

    private $wikiId;
    private $wikiTitle;
    private $wikiText;
    private $categoryId;
    private $userId;
    private $wikiStatus;

    private $release_date;

    private $wikiImage;

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
                $wiki->__set('release_date' , $row['release_date']);
                $image  = $row['wikiImage'];
                $image64base = base64_encode($image);
                $wiki->__set('wikiImage' , $image64base);
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

        public function delete_wiki_by_id() {
            $delete = $this->db->prepare('DELETE FROM wiki WHERE wikiId = :id');
            $delete->bindValue(':id' , $this->wikiId , PDO::PARAM_INT);
            $delete->execute();
        }

        public function delete_wiki_tags() {
            $delete = $this->db->prepare('DELETE FROM wikitag WHERE wikiId = :id');
            $delete->bindValue(':id' , $this->wikiId , PDO::PARAM_INT);
            if($delete->execute()){
                $this->delete_wiki_by_id();
            }
        }


        public function search() {
            $like = $this->__get('wikiTitle').'%';
            $search = $this->db->prepare('SELECT wiki.*, utilisateur.userName, category.categoryName, GROUP_CONCAT(tag.tagName) AS tagNames FROM wiki 
            JOIN utilisateur ON utilisateur.userId = wiki.userId 
            JOIN wikitag ON wikitag.wikiId = wiki.wikiId 
            JOIN category ON category.categoryId = wiki.categoryId 
            JOIN tag ON tag.tagId = wikitag.tagId WHERE wiki.wikiTitle LIKE :like OR category.categoryName LIKE :like OR tag.tagName LIKE :like GROUP BY wiki.wikiId;
            ');
            $search->bindValue(':like' , $like , PDO::PARAM_STR);
            $search->execute();
            $result = $search->fetchALl(PDO::FETCH_ASSOC);
            return $result;
        }


        public function latest_wikis () {
            $latest = $this->db->query('SELECT * FROM wiki ORDER BY release_date DESC LIMIT 8');
            $result = $latest->fetchAll(PDO::FETCH_ASSOC);

            $wikis = [];
            foreach($result as $row) {
                $wiki = new wikis();
                $wiki->__set('wikiId' , $row['wikiId']);
                $wiki->__set('wikiTitle' , $row['wikiTitle']);
                $wiki->__set('wikiText' , $row['wikitext']);
                $wiki->__set('categoryId' , $row['categoryId']);
                $wiki->__set('userId' , $row['userId']);
                $wiki->__set('wikiStatus' , $row['wikiStatus']);
                $wiki->__set('release_date' , $row['release_date']);
                $image  = $row['wikiImage'];
                $image64base = base64_encode($image);
                $wiki->__set('wikiImage' , $image64base);
                $wikis [] = $wiki;
            }

            return $wikis;
        }




        public function insert_wiki() {
            $insert = $this->db->prepare('INSERT INTO wiki (wikiTitle,wikiText,categoryId,userId,wikiImage) VALUES (:title,:text,:id,:user,:image)');
            $insert->bindValue(':title' , $this->wikiTitle , PDO::PARAM_STR);
            $insert->bindValue(':text' , $this->wikiText , PDO::PARAM_STR);
            $insert->bindValue(':id' , $this->categoryId , PDO::PARAM_INT);
            $insert->bindValue(':user' , $this->userId , PDO::PARAM_INT);
            $insert->bindValue(':image' , $this->wikiImage , PDO::PARAM_LOB);
            $insert->execute();

            $lastinsertedId = $this->db->lastInsertId();

            return $lastinsertedId;


        }


        public function get_wiki_by_id() {
            try {
                $get = $this->db->prepare('SELECT * FROM wiki WHERE wikiId = :id');
                $get->bindValue(':id', $this->wikiId, PDO::PARAM_INT);
                $get->execute();
                
                $result = $get->fetch(PDO::FETCH_ASSOC);
        
                if (!$result) {

                    throw new Exception("Wiki with ID {$this->wikiId} not found.");
                }
        
                $this->wikiId = $result['wikiId'];
                $this->wikiTitle = $result['wikiTitle'];
                $this->wikiText = $result['wikitext'];
                $this->categoryId = $result['categoryId'];
                $this->wikiStatus = $result['wikiStatus'];
                $this->release_date = $result['release_date'];
                $this->wikiImage = $result['wikiImage'];
                $this->userId = $result['userId'];
        
                return true;
            } catch (Exception $e) {
                header("Location: ../errorpage");
                exit();
            }
        }
        



}