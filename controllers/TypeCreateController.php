<?php
require_once "BaseAnimalsController.php";
class TypeCreateController extends BaseAnimalsController{
    public $template="type_create.twig";

     public function get(array $context) // добавили параметр
    {
        //echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); // пробросили параметр
    }
    public function post(array $context) { 
        
        $nameType = $_POST['name'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        $image_url = "/media/$name";


        $sql = <<<EOL
INSERT INTO `type` (name, image)
VALUES (:nameType, :image_url)
EOL;
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("nameType", $nameType);
        $query->bindValue("image_url", $image_url);
        
        // выполняем запрос
        $query->execute();
        $context['id'] = $this->pdo->lastInsertId();
        move_uploaded_file($tmp_name, "../public/media/$name");
        $context['message'] = 'Вы успешно создали объект'; // добавили сообщение

        $this->get($context); // пробросили параметр
    }

}
