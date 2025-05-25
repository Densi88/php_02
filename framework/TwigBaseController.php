<?php
    require_once "BaseController.php";

    class TwigBaseController extends BaseController{
        public $title = ""; // название страницы
        public $template = ""; // шаблон страницы
        protected \Twig\Environment $twig; // ссылка на экземпляр twig, для рендернига
        
    
        public function setTwig($twig) {
        $this->twig = $twig;
    }
    
        public function getContext() : array
        {
            $context = parent::getContext(); // вызываем родительский метод
            $context['title'] = $this->title; // добавляем title в контекст
            $context['menu'] = [
                [
                    "title" => "Главная",
                    "url" => "/",
                ],
                [
                    "title" => "Котики",
                    "url" => "/cats",
                ],
                [
                    "title" => "Собачки",
                    "url" => "/dogs",
                ]
            ];

            return $context;
        }
        public function get() {
            echo $this->twig->render($this->template, $this->getContext());
        }
    }