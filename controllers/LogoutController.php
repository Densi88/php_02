<?php
require_once "../framework/TwigBaseController.php";
    class LogoutController extends TwigBaseController{
        public function get(array $context) {
            parent::get($context);
    }
    public function post(array $context) { 
       $_SESSION["is_logged"]=false;
       header("Location: /login");
        $this->get($context); // пробросили параметр
    }

    }