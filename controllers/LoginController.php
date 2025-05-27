<?php
require_once "../framework/TwigBaseController.php";
    class LoginController extends TwigBaseController{
         public $template = "_login.twig";
        
        public function get(array $context) {
            parent::get($context);
    }
    public function post(array $context) { 
        $user = $_POST['username'];
        $password =$_POST['password'];
       

        $user_query = $this->pdo->prepare("SELECT username FROM users WHERE username=:user");
        $user_query->bindValue("user", $user);
        $user_query->execute();
        $valid_user=$user_query->fetch(PDO::FETCH_COLUMN);
        if($valid_user==null){
            $_SESSION["is_logged"] = false;
        }

        $password_query = $this->pdo->prepare("SELECT password FROM users WHERE username=:user");
        $password_query->bindValue("user", $user);
        $password_query->execute();
        $valid_password=$password_query->fetch(PDO::FETCH_COLUMN);

        if ($valid_user == $user && $valid_password == $password) {
                 $_SESSION["is_logged"] = true;
                 header("Location: /");
            } 
        else{
            $_SESSION["is_logged"] = false;
        }

        $this->get($context); // пробросили параметр
    }

    }