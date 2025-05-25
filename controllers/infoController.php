<?php
    class infoController extends TwigBaseController{
        public $template="info.twig";
        public function getContext() : array
        {
             $id=$this->params['id'];
            $context=parent::getContext();
             $query = $this->pdo->prepare("SELECT info, id FROM animals WHERE id= :my_id");
             $query->bindValue("my_id", $this->params['id']);
            $query->execute(); // выполняем запрос
            $data = $query->fetch();
            $context['info'] = $data['info'];
            $submenu=[
                ["title"=>"Информация",
                    "url"=> "/animal/{$id}/info",
                ],
                [
                    "title"=>"Картинка",
                    "url"=>"/animal/{$id}/image",
                ]
            ];
            $context['submenu'] = $submenu;
             $context['current_route'] = $_SERVER['REQUEST_URI'] ?? '/';
            return $context;
        }
    }