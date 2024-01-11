<?php

class home extends Controller {
    public function index () {
        $this->view('home/index');
    }


    public function searchbar() {
        if(isset($_POST['search'])){


            if(!empty($_POST['search'])){
                $search = $_POST['search'];
            $CATEGORY = $this->model('category');

            $CATEGORY->__set('categoryName' , $search);
            $ALLCATEGORYS = $CATEGORY->search();
            $data=['categorys' => []];
            if($ALLCATEGORYS) {
                foreach($ALLCATEGORYS as $category) {
                    $data['categorys'][] = $category['categoryName'];
                }
            }
            header('Content-Type: application/json');
            echo json_encode($data);
            }
            else {
                $data = [];
                header('Content-Type: application/json');
                 echo json_encode($data);
            }

            
            

            
        }
    }
}   