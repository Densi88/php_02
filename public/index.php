<?php
// подключаем пакеты которые установили через composer
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/AnimalCreateController.php";
require_once "../controllers/TypeCreateController.php";
require_once "../controllers/DeleteObjectController.php";
require_once "../controllers/UpdateController.php";
require_once "../middlewares/LoginRequiredMiddleware.php";
require_once "../controllers/SetWelcomeController.php";
require_once "../framework/BaseMidleware.php";
require_once "../controllers/SetHistoryController.php";

$pdo = new PDO("mysql:host=localhost;dbname=home_animals;charset=utf8", "root", "");


// создаем загрузчик шаблонов, и указываем папку с шаблонами
// \Twig\Loader\FilesystemLoader -- это типа как в C# писать Twig.Loader.FilesystemLoader, 
// только слеш вместо точек
$loader = new \Twig\Loader\FilesystemLoader('../views');


// создаем собственно экземпляр Twig с помощью которого будет рендерить
$twig = new \Twig\Environment($loader,[
   "debug"=>true,
   "cache"=>false
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение
$template="";
$title="";
$context = [];
$controller=null;
$router = new Router($twig, $pdo);
//$router->add("/$", SetHistoryController::class);
$router->add("/$", MainController::class);
$router->add("/animal/(?P<id>\d+)/?$", ObjectController::class);
$router->add("/search/?$", SearchController::class);
$router->add("/add/types/?$", TypeCreateController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/add/?$", AnimalCreateController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/animal/delete/?$", DeleteObjectController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/animal/(?P<id>\d+)/edit/?$", UpdateController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/set-welcome", SetWelcomeController::class);
echo $router->get_or_default(MainController::class);