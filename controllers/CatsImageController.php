<?php
require_once "CatsController.php";
class CatsImageController extends CatsController{
   public $template="image.twig";
   public $title="Картинка";
   public function getContext():array{
    $context=parent::getContext();
    $context['base']="cats";
    $context['title'] = $this->title;
    $context['image']="/image/kot.jpg"; 
    return $context;
}

}