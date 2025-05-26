<?php
require_once "BaseAnimalsController.php";

class AnimalCreateController extends BaseAnimalsController {
    public $template = "animal_create.twig";

    public function get(array $context) // добавили параметр
    {
        //echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); // пробросили параметр
    }

    public function post(array $context) { 
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        $image_url = "/media/$name";


        $sql = <<<EOL
INSERT INTO animals(title, description, type, info, image)
VALUES(:title, :description, :type, :info, :image_url)
EOL;
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        
        // выполняем запрос
        $query->execute();
        $context['id'] = $this->pdo->lastInsertId();
        move_uploaded_file($tmp_name, "../public/media/$name");
        $context['message'] = 'Вы успешно создали объект'; // добавили сообщение

        $this->get($context); // пробросили параметр
    }
}