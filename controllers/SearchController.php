<?php
require_once "BaseAnimalsController.php";

class SearchController extends BaseAnimalsController {
    public $template = "search.twig";
    
    public function getContext(): array {
        $context = parent::getContext();
        
        // Получаем и фильтруем параметры
        $type = $_GET['type'] ?? '';
        $title = $_GET['title'] ?? '';
        $description=$_GET['description']?? '';
        
        // SQL-запрос с защитой от инъекций
        $sql = "SELECT id, title, description, image FROM animals 
                WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%'))
                AND (:type = '' OR type = :type)
                AND (:description = '' OR description LIKE CONCAT('%', :description, '%'))";
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("type", $type);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->execute();
        
        $context['objects'] = $query->fetchAll();
        $context['search_type'] = $type; // Для сохранения выбора в форме
        $context['search_title'] = $title; // Для сохранения ввода в форме
        $context['description']=$description;
        
        return $context;
    }
}