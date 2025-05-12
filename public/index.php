<?php
// подключаем пакеты которые установили через composer
require_once '../vendor/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/DogsController.php";
require_once "../controllers/CatsController.php";
require_once "../controllers/CatsInfoController.php";
require_once "../controllers/CatsImageController.php";
require_once "../controllers/DogsInfoController.php";
require_once "../controllers/DogsImageController.php";
$pdo = new PDO("mysql:host=localhost;dbname=home_animals;charset=utf8", "root", "");


// создаем загрузчик шаблонов, и указываем папку с шаблонами
// \Twig\Loader\FilesystemLoader -- это типа как в C# писать Twig.Loader.FilesystemLoader, 
// только слеш вместо точек
$loader = new \Twig\Loader\FilesystemLoader('../views');


// создаем собственно экземпляр Twig с помощью которого будет рендерить
$twig = new \Twig\Environment($loader,[
   "debug"=>true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение
$template="";
$title="";
$context = [];
$controller=null;

$url = $_SERVER["REQUEST_URI"];
if ($url == "/") {
    $controller=new MainController($twig);
}
elseif(preg_match("#/dogs/info#", $url)){
    $controller=new DogsInfoController($twig);
}
elseif(preg_match("#/cats/info#", $url)){
   $controller=new CatsInfoController($twig);
}
elseif(preg_match("#/dogs/image#", $url)){
   $controller=new DogsImageController($twig);
}
elseif(preg_match("#/cats/image#", $url)){
   $controller=new CatsImageController($twig);
}
elseif (preg_match("#/cats#", $url)) {
   $controller=new CatsController($twig);
}
 elseif (preg_match("#/dogs#", $url)) {
    $controller=new DogsController($twig);
}
if($controller){
   $controller->setPdo($pdo);
    $controller->get();
}
