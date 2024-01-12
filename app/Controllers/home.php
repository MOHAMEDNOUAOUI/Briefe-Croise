<?php

class home extends Controller {
    public function index () {
        $wikis = $this->model('wikis');
        $LATESTWIKIS = $wikis->latest_wikis();
        $categorys = $this->model('category');
        $LATESTCATEGORYS = $categorys->latest_category();

        $tags = $this->model('tags');
        $ALLTAGS = $tags->get_all_tags();


        $ALLCATEGORYS = $categorys->get_all_categorys();
        $this->view('home/index' , $data = [ 'wikislatest' => $LATESTWIKIS ,
                                            'categoryslatest' => $LATESTCATEGORYS,
                                            'allcategorys' =>$ALLCATEGORYS,
                                            'alltags' => $ALLTAGS
                    ]);
    }


    public function errorpage () {
        $this->view('home/errorpage');
    }




    public function wikiindex($wikiId) {
        $wikiclass = $this->model('wikis');
        $wikiclass->__set('wikiId' , $wikiId);
        $status = $wikiclass->get_wiki_by_id();

        $categoryclass = $this->model('category');
        $categoryclass->__set('categoryId' ,$wikiclass->__get('categoryId'));
        $categoryclass->get_category_by_name ();


        $userclass = $this->model('User');
        $userclass->__set('userId' , $wikiclass->__get('userId'));
        $userclass->get_user_by_id();

        $image = $wikiclass->__get('wikiImage');
        $image64 = base64_encode($image);

        $tagclass = $this->model('tags');
        $tags = $tagclass->get_tags_by_wiki_id($wikiId);

        
        $formattedTags = [];

        foreach ($tags as $tag) {
            $formattedTags[] = [
                'tagId' => $tag['tagId'],
                'tagName' => $tag['tagName']
            ];
        }



        $data = [
            'wikiId' => $wikiclass->__get('wikiId'),
            'wikiTitle' => $wikiclass->__get('wikiTitle'),
            'wikiText' => $wikiclass->__get('wikiText'),
            'categoryName' => $categoryclass->__get('categoryName'),
            'wikiStatus' => $wikiclass->__get('wikiStatus'),
            'release_date' => $wikiclass->__get('release_date'),
            'wikiImage' => $image64,
            'userId' => $wikiclass->__get('userId'),
            'userName' => $userclass->__get('userName'),
            'tags' => $formattedTags
        ];
        if($status) {
            $this->view('home/wikiindex' , $data);
        }
        else {
            echo "aa";
        }
    }




    public function searchbar() {
        if (isset($_POST['search'])) {
            $wiki = $this->model('wikis');
            $search = $_POST['search'];
    
            if (!empty($search)) {
                $wiki->__set('wikiTitle', $search);
                $SEARCHWIKIS = $wiki->search();
    
                $formattedResults = [];
                foreach ($SEARCHWIKIS as $result) {
                 
                    $image64 = base64_encode($result['wikiImage']);
                    $tags = explode(',', $result['tagNames']);
                    
    
                    $formattedResult = [
                        'wikiId' => $result['wikiId'],
                        'wikiTitle' => $result['wikiTitle'],
                        'wikiImage' => $image64,
                        'userName' => $result['userName'],
                        'categoryName' => $result['categoryName'],
                        'tagName' => $tags
                    ];
                    $formattedResults[] = $formattedResult;
                }
    
                header('Content-Type: application/json');
                echo json_encode($formattedResults);
            }
        }
    }


    public function Upload() {
        if(isset($_FILES['myFile']) && isset($_POST['title']) && isset($_POST['category']) && isset($_POST['tags'])){
            

            $title = $_POST['title'];
            $category = $_POST['category'];
            $tags = $_POST['tags'];
            $text = $_POST['text'];

            $USER = $this->model('User');
            $TAGS = $this->model('tags');
            

            if ($_FILES['myFile']['error'] === UPLOAD_ERR_OK) {
                $tempName = $_FILES['myFile']['tmp_name'];
                $imageData = file_get_contents($tempName);
            }


            $wikiclass = $this->model('wikis');
            $wikiclass->__set('wikiTitle' , $title);
            $wikiclass->__set('wikiText' , $text);
            $wikiclass->__set('userId' , $_SESSION['userId']);
            $wikiclass->__set('categoryId' , $category);
            $wikiclass->__set('wikiImage' , $imageData);

            $last_id = $wikiclass->insert_wiki();


            foreach($tags as $tag) {
                $TAGS->__set('tagId' , $tag);
                $TAGS->insert_tagpevot($last_id);
            }



            $_POST['title'] == '';
            $_POST['category'] == '';
            $_POST['tags'] == '';
            $_POST['text'] == '';


            header('location: ../home/index');
        }
    }
    
}   