<?php
    
    class DogsController extends TwigBaseController{
        public $template="dogs.twig";
        public $title="Собачки";
        public function getContext():array{
            $context=parent::getContext();
            $context['base']="dogs";
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