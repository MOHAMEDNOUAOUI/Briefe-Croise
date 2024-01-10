<?php
require_once 'database.php';

class User  {

    private $userId;
    private $userName;
    private $userEmail;
    private $userPwd;
    private $userRole;

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

    public function userStats () {
        $get = $this->db->query('SELECT COUNT(userId) FROM utilisateur WHERE userRole = "auteur"');
        $result = $get->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    public function get_all_users() {
            $all = $this->db->query('SELECT * FROM utilisateur');
            $result = $all->fetchAll(PDO::FETCH_ASSOC);
            $users = [];
            foreach($result as $row){
                $user = new User();
                $user->__set('userId' , $row['userId']);
                $user->__set('userName' , $row['userName']);
                $user->__set('userEmail' , $row['userEmail']);

                $users [] =$user;
            }
            return $users;
    }

    public function get_user_by_id() {
        $id = $this->__get('userId');
        $get = $this->db->prepare('SELECT * FROM utilisateur WHERE userId = :id');
        $get->bindParam(':id' ,$id , PDO::PARAM_INT);
        $get->execute();
        $result = $get->fetch(PDO::FETCH_ASSOC);
        $this->__set('userId',$result['userId']);
        $this->__set('userName' , $result['userName']);
    }


}