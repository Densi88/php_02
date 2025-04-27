<?php
    require_once "TwigBaseController.php";
    class CatsController extends TwigBaseController{
        public $template="cats.twig";
        public $title="Котики";
        public function getContext():array{
            $context=parent::getContext();
            $context['base']="cats";
            $context['title'] = $this->title;
            $submenu=[
                ["title"=>"Информация",
                    "url"=>"/{{ base }}/info",
                ],
                [
                    "title"=>"Картинка",
                    "url"=>"/{{ base }}/image",
                ]
            ];
            $context['submenu']=$submenu;
            //$context['menu'] = $menu; 
            return $context;
        }
    }