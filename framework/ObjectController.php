<?php
require_once "../controllers/BaseAnimalsController.php";

class ObjectController extends BaseAnimalsController {
    public $template = "_object.twig";
    
    public function getContext(): array {
        $id = $this->params['id'];
        $context = parent::getContext();
        
        // Получаем параметр show из GET-запроса
        $showParam = $_GET['show'] ?? '';
        
        // Обработка разных вариантов через switch
        switch ($showParam) {
            case 'info':
                $this->template = "info.twig";
                $query = $this->pdo->prepare("SELECT info FROM animals WHERE id = :my_id");
                $query->bindValue("my_id", $id);
                $query->execute();
                $data = $query->fetch();
                $context['info'] = $data['info'] ?? 'Нет информации';
                break;
                
            case 'image':
                $this->template = "image.twig";
                $query = $this->pdo->prepare("SELECT image FROM animals WHERE id = :my_id");
                $query->bindValue("my_id", $id);
                $query->execute();
                $data = $query->fetch();
                $context['image'] = $data['image'] ?? 'Нет изображения';
                break;
                
            default:
                $this->template = "_object.twig";
                // Можно загрузить оба типа данных для основного шаблона
                $query = $this->pdo->prepare("SELECT info, image FROM animals WHERE id = :my_id");
                $query->bindValue("my_id", $id);
                $query->execute();
                $data = $query->fetch();
                $context['info'] = $data['info'] ?? 'Нет информации';
                $context['image'] = $data['image'] ?? 'Нет изображения';
                break;
        }
        
        // Формируем меню
        $context['submenu'] = [
            [
                "title" => "Информация",
                "url" => "/animal/{$id}/?show=info",
            ],
            [
                "title" => "Картинка",
                "url" => "/animal/{$id}/?show=image",
            ]
        ];
        
        $context['current_route'] = $_SERVER['REQUEST_URI'] ?? '/';
        
        return $context;
    }
}