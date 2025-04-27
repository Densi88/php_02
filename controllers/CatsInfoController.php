<?php
require_once "CatsController.php";
class CatsInfoController extends CatsController{
    public $template="infoCats.twig";
    public $title="Информация";
    public function getContext():array{
        $context=parent::getContext();
        $context['base']="cats";
        $context['title'] = $this->title; 
        return $context;
    }
}