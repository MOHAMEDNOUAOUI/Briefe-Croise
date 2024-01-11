<?php

class dashboard extends Controller {

    public function logout() {

        session_start();
        if(isset($_SESSION['userId'])){


        
        session_unset();
        session_destroy();

       


        header('location: ../usercontroller/indexlogin');

        }

        echo $_SESSION['userId'];
      
    }


    public function index () {
        $CATEGORY = $this->model('category');
        $ALLCATEGORYS = $CATEGORY->get_all_categorys();
        $CATEGORYSTATS = $CATEGORY->categoryStats();

        //model user
        $USER = $this->model('User');
        $USERSTATS = $USER->userStats();

        $USER->__set('userId', $_SESSION['userId']);
        $USER->get_user_by_id();


        // model wiki


        //getiing wikis plus the auteur plus the category plus the tags
        $WIKIS = $this->model('wikis');
        $ALLWIKIS = $WIKIS->get_all_wikis();
        $WIKIs = [];
        foreach($ALLWIKIS as $wiki){
            $userId = $wiki->__get('userId');
            
            $USER->__set('userId' , $userId);
            $USER->get_user_by_id();
            $username = $USER->__get('userName');


            $categoryId = $wiki->__get('categoryId');
            $CATEGORY->__set('categoryId' , $categoryId);
            $CATEGORY->get_category_by_name();
            $categoryName = $CATEGORY->__get('categoryName');
            $WIKIs [] = [
                'WIKI' => $wiki,
                'USER' => $username,
                'CATEGORY' =>$categoryName
            ];
        }






        $WIKISTATS = $WIKIS-> wikiStats ();

        //model tags
        $TAGS = $this->model('tags');
        $TAGSSTATS = $TAGS->tagStats();
        if(isset($_SESSION['userId'])) {
            $this->view('dashboard/index' , $data = ['category' => $ALLCATEGORYS , 
                'categorystats' => $CATEGORYSTATS ,
            'USERSTATS' => $USERSTATS ,
            'TAGSSTATS' => $TAGSSTATS,
            'WIKISTATS' => $WIKISTATS,
            'ALLWIKIS' => $WIKIs,
            'USERNAME' => $USER->__get('userName')
        ]);
        }
        else {
            header('location: usercontroller/indexlogin');
        }
    }


    public function user () {
        $USER = $this->model('User');
        $ALLUSERS = $USER->get_all_users();
        if(isset($_SESSION['userId'])){
            $this->view('dashboard/user' ,$data = ['ALLUSERS' => $ALLUSERS]);
        }else {
            header('location: usercontroller/indexlogin');
        }
        
    }

    public function category() {
        $CATEGORY = $this->model('category');
        $ALLCATEGORYS = $CATEGORY->get_all_categorys ();
        if(isset($_SESSION['userId'])){
            $this->view('dashboard/category',$data = ['CATEGORIES' => $ALLCATEGORYS]);
        }else {
            header('location: usercontroller/indexlogin');
        }
        
    }

    public function tags () {
        $TAGS = $this->model('tags');
        $ALLTAGS = $TAGS->get_all_tags();
       
        if(isset($_SESSION['userId'])){
 $this->view('dashboard/tags',$data = ['TAGS' =>$ALLTAGS]);
        }else {
            header('location: usercontroller/indexlogin');
        }
    }

    public function change_status() {
        if(isset($_POST['wikiId'])){
            $wikiId = $_POST['wikiId'];
            $textcontent = $_POST['status'];
            
            if($textcontent == 'archived'){
                echo "active";
            }
            elseif($textcontent == 'active') {
                echo 'archived';
            }

          
           $WIKIS = $this->model('wikis');
           $WIKIS->__set('wikiId' , $wikiId);
            $WIKIS->change_status();

            
        }
    }


    public function delete() {
        if(isset($_POST['categoryId'])){
            $categoryId = $_POST['categoryId'];

            $CATEGORY = $this->model('category');
            $WIKI = $this->model('wikis');
            
            
            $WIKI->__set('categoryId' , $categoryId);
            $CATEGORY->__set('categoryId' , $categoryId);


            $WIKI->delete_wiki();
            $CATEGORY->delete_category();
        }
        elseif(isset($_POST['tagId'])){
            $tagId = $_POST['tagId'];
            $TAG = $this->model('tags');

            $TAG->__set('tagId' ,$tagId);
            $TAG->delete_tag();
        }
    }


    public function modify() {
        if(isset($_POST['categoryId']) && isset($_POST['input'])){
            $categoryId = $_POST['categoryId'];
            $categoryName = $_POST['input'];


            $CATEGORY = $this->model('category');
            $CATEGORY->__set('categoryId' , $categoryId);
            $CATEGORY->__set('categoryName' , $categoryName);
            $CATEGORY->modify_category();
        }
        elseif(isset($_POST['tagId']) && isset($_POST['input'])){
            $tagId = $_POST['tagId'];
            $tagName = $_POST['input'];


            $TAG = $this->model('tags');
            $TAG->__set('tagId' , $tagId);
            $TAG->__set('tagName' , $tagName);


            $TAG->modify_tag();
        }
    }



    public function add() {
        if(isset($_POST['categoryName'])){
            $categoryName = $_POST['categoryName'];
            $CATEGORY = $this->model('category');
            $CATEGORY->__set('categoryName' , $categoryName);
            $CATEGORY->insertCategory();
        }
        elseif(isset($_POST['tagName'])){
            $tagName = $_POST['tagName'];

            $TAGS = $this->model('tags');
            $TAGS->__set('tagName' , $tagName);
            $TAGS->insert_tag();
           } 
    }
}