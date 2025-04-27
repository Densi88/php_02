<?php
require_once "DogsController.php";
class DogsImageController extends DogsController{
    public $template="image.twig";
    public $title="Картинка";
    public function getContext():array{
        $context=parent::getContext();
        $context['base']="dogs";
        $context['title'] = $this->title;
        $context['image']="/image/korgi.jpg"; 
        return $context;
    }
}