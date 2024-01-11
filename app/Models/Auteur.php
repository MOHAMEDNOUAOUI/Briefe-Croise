<?php


require_once 'User.php';


class Auteur extends User {
    public function register() {
        $register = $this->db->prepare('INSERT INTO utilisateur (userName,userEmail,userPassword) VALUES (:username,:email,:pwd)');
        $register->bindValue(':username' , $this->__get('userName') , PDO::PARAM_STR);
        $register->bindValue(':email' , $this->__get('userEmail'), PDO::PARAM_STR);
        $register->bindValue(':pwd' , $this->__get('userPwd'), PDO::PARAM_STR);
        $register->execute();
    }
}