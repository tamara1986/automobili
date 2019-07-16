<?php
    class Login extends Controller {
        public function __construct() {
            $this->userModel=$this->model('User');
        }
        public function index() {
            $data = [
                'title' => 'Login',
            ];
            $this->view('pages/index', $data);
        }
        public function signIn() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['insurance_form'] == 1){
                if(isset($_POST['form_data'])){
                    $datas=[
                        'username' => $_POST['form_data']['username'],
                        'password' =>md5($_POST['form_data']['password'])
                    ];
                    $data=User::validateData($datas['username'],$datas['password']);
                    if (count($data)==0) {
                         echo json_encode('false');
                    }
                    if (count($data)==1) {
                        if ($data[0]['id_role']==2) {
                            $_SESSION['user']='user';
                            $_SESSION['username']=$data[0]['username'];
                            $_SESSION['password']=$data[0]['password'];
                            echo json_encode($_SESSION['user']);
                        }
                        if ($data[0]['id_role']==1) {
                            $_SESSION['user']='admin';
                            $_SESSION['username']=$data[0]['username'];
                            $_SESSION['password']=$data[0]['password'];
                            echo json_encode($_SESSION['user']);
                        }
                        
                    }
                       
                    
                }

            
            }
      
      

        }
            

        public function logoutUser(){
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
                session_destroy();
                header("Location: ".URLROOT);
            }
        }
        
    }