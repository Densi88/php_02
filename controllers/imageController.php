<?php
    class imageController extends TwigBaseController{
        public $template="image.twig";
        public function getContext() : array
        {
            $id=$this->params['id'];
            $context=parent::getContext();
             $query = $this->pdo->prepare("SELECT image, id FROM animals WHERE id= :my_id");
             $query->bindValue("my_id", $this->params['id']);
            $query->execute(); // выполняем запрос
            $data = $query->fetch();
            $context['image'] = $data['image'];
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