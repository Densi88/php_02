<?php
require_once "DogsController.php";
class DogsInfoController extends DogsController{
    public $template="dogs_info.twig";
    public $title="Информация";
    public function getContext():array{
        $context=parent::getContext();
        $context['base']="dogs";
        $context['title'] = $this->title;
        return $context;
    }
}