<?php
require_once "BaseAnimalsController.php";

class UpdateController extends BaseAnimalsController {
    public $template = "animal_update.twig";

     public function get(array $context) {
        $id = $this->params['id'];
        
        $sql = <<<EOL
SELECT * FROM animals WHERE id = :id
EOL;
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();
        
        $data = $query->fetch();
        $context['object'] = $data;
        
       parent::get($context); 
    }
    
    public function post(array $context) {
        $id = $this->params['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
         $info = $_POST['info'];
         $type = $_POST['type'];
        $typeQuery = $this->pdo->prepare("SELECT id FROM `type` WHERE name = :type");
        $typeQuery->bindValue("type", $type);
        $typeQuery->execute();
        $typeId=$typeQuery->fetch(PDO::FETCH_COLUMN);
        
        $sql = <<<EOL
UPDATE animals
SET title = :title, description = :description, info=:info,  type_id=:type_id 
WHERE id = :id
EOL;
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":id", $id);
        $query->bindValue(":title", $title);
        $query->bindValue(":description", $description);
        $query->bindValue(":info", $info);
        $query->bindValue(":type_id", $typeId);
        $query->execute();
        
        $context['message'] = 'Объект успешно обновлён';
        $this->get($context);
    }
}