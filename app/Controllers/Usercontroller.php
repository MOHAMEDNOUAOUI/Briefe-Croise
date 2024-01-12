<?php

class Usercontroller extends Controller {
    public function indexLogin() {
        $this->view('user/login');
    }

    public function indexRegister() {
        $this->view('user/register');
    }


    public function register() {
        if(isset($_POST['email']) && isset($_POST['username'])){
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $hashedpassword = password_hash($password , PASSWORD_DEFAULT);


            // $USERclass = $this->model('User');
            try {
                $user = $this->model('User');
            $user->__set('userEmail' , $email);
            $user->__set('userName',$username);
            $user->__set('userPwd' , $hashedpassword);
            $user->register();
            echo '';
            }
            catch (PDOException $e){
                echo "ACCOUNT ALREADY EXIST";
            }
        }
    }


    public function login() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $user = $this->model('User');
    
                $user->__set('userEmail', $email);
                $userInformations = $user->get_user_by_email();
    
                if ($userInformations) {
                    if (password_verify($password, $userInformations['userPassword'])) {
                        
                        if($userInformations['userRole'] == 'admin') {
                            $response = [
                                'status' => 'success',
                                'message' => 'Login successful',
                                'page' => '../dashboard'
                            ];
                           
                        }
                        else {
                            $response = [
                                'status' => 'success',
                                'message' => 'Login successful',
                                'page' => '../hox²me'
                            ];
                        }

                        
                        $_SESSION['userId'] = $userInformations['userId'];
    
                    } else {
                        
                        $response = [
                            'status' => 'error',
                            'message' => 'Password is incorrect',
                        ];
    
                    }
                }else {
                    
                    $response = [
                        'status' => 'error',
                        'message' => 'Account doesnt Exist'
                    ];

                }
            

                header('Content-Type: application/json');
                echo json_encode($response);
        }
    }
    
}