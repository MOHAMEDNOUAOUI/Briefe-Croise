<?php


class dashboard extends Controller {
    public function index () {
        $CATEGORY = $this->model('category');
        $ALLCATEGORYS = $CATEGORY->get_all_categorys();
        $CATEGORYSTATS = $CATEGORY->categoryStats();

        //model user
        $USER = $this->model('User');
        $USERSTATS = $USER->userStats();


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
        $this->view('dashboard/index' , $data = ['category' => $ALLCATEGORYS , 
                'categorystats' => $CATEGORYSTATS ,
            'USERSTATS' => $USERSTATS ,
            'TAGSSTATS' => $TAGSSTATS,
            'WIKISTATS' => $WIKISTATS,
            'ALLWIKIS' => $WIKIs
        ]);
    }


    public function user () {
        $USER = $this->model('User');
        $ALLUSERS = $USER->get_all_users();
        $this->view('dashboard/user' ,$data = ['ALLUSERS' => $ALLUSERS]);
    }

    public function category() {
        $CATEGORY = $this->model('category');
        $ALLCATEGORYS = $CATEGORY->get_all_categorys ();
        $this->view('dashboard/category',$data = ['CATEGORIES' => $ALLCATEGORYS]);
    }

    public function tags () {
        $TAGS = $this->model('tags');
        $ALLTAGS = $TAGS->get_all_tags();
        $this->view('dashboard/tags',$data = ['TAGS' =>$ALLTAGS]);
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