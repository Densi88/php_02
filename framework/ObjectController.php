<?php
    class ObjectController extends TwigBaseController{
        public $template="_object.twig";
        public function getContext() : array
        {
            $id=$this->params['id'];
            $context=parent::getContext();
             $query = $this->pdo->prepare("SELECT info, id FROM animals WHERE id= :my_id");
             $query->bindValue("my_id", $id);
            $query->execute(); // выполняем запрос
            $data = $query->fetch();
            $submenu=[
                ["title"=>"Информация",
                    "url"=> "/animal/{$id}/info",
                ],
                [
                    "title"=>"Картинка",
                    "url"=>"/animal/{$id}/image",
                ]
            ];
            $context['current_route'] = $_SERVER['REQUEST_URI'] ?? '/';
            $context['submenu'] = $submenu;
            return $context;
        }
    }