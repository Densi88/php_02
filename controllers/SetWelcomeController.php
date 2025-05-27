<?php
    class SetWelcomeController extends BaseController{
        public function get(array $context){
            $url=$_SERVER['HTTP-REFERER'];
            header("Location: $url");
            exit;
        }
    }