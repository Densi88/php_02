<?php
  require_once "BaseAnimalsController.php";
  require_once "SetHistoryController.php";
   
   class MainController extends BaseAnimalsController{
        public $template="main.twig";
        public $title="Главная";
        public function getContext(): array
    {
        $context = parent::getContext();
        $history = new SetHistoryController();
        $context = $history->get($context);
        if(isset($_GET['type'])){
            $query=$this->pdo->prepare("SELECT animals.* FROM animals JOIN `type` ON animals.type_id = `type`.id WHERE `type`.name = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        }else{
            $query=$this->pdo->query("SELECT * FROM animals");
        }
        
        // подготавливаем запрос SELECT * FROM space_objects
        // вообще звездочку не рекомендуется использовать, но на первый раз пойдет
        
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['animals'] = $query->fetchAll();
        $context["visit_history"] = isset($_SESSION['visit_history']) ? $_SESSION['visit_history'] : "";

        return $context;
    }
   }