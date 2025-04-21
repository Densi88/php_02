<?php
// подключаем пакеты которые установили через composer
require_once '../vendor/autoload.php';

// создаем загрузчик шаблонов, и указываем папку с шаблонами
// \Twig\Loader\FilesystemLoader -- это типа как в C# писать Twig.Loader.FilesystemLoader, 
// только слеш вместо точек
$loader = new \Twig\Loader\FilesystemLoader('../views');

// создаем собственно экземпляр Twig с помощью которого будет рендерить
$twig = new \Twig\Environment($loader);
$template="";
$title="";
$context = [];
$url = $_SERVER["REQUEST_URI"];
if ($url == "/") {
    $template="main.twig";
    $title="Главная";

}
elseif(preg_match("#/dogs/info#", $url)){
    $template="dogs_info.twig";
    $title="Информация";
    $context['base']="dogs";
}
elseif(preg_match("#/cats/info#", $url)){
    $template="infoCats.twig";
    $title="Информация";
    $context['base']="cats";
}
elseif(preg_match("#/dogs/image#", $url)){
    $template="image.twig";
    $title="Картинка";
    $context['image']="/image/korgi.jpg";
    $context['base']="dogs";
}
elseif(preg_match("#/cats/image#", $url)){
    $template="image.twig";
    $title="Картинка";
    $context['image']="/image/kot.jpg";
    $context['base']="cats";
}
elseif (preg_match("#/cats#", $url)) {
   $template="cats.twig";
   $title="Котики";
   $context['base']="cats";
}
 elseif (preg_match("#/dogs#", $url)) {
    $template="dogs.twig";
    $title="Собачки";
    $context['base']="dogs";
}
$menu = [ 
    [
        "title" => "Главная",
        "url" => "/",
    ],
    [
        "title" => "Котики",
        "url" => "/cats",
    ],
    [
        "title" => "Собачки",
        "url" => "/dogs",
    ]
];
$submenu=[
    ["title"=>"Информация",
        "url"=>"/{{ base }}/info",
    ],
    [
        "title"=>"Картинка",
        "url"=>"/{{ base }}/image",
    ]
];
$context['title'] = $title;
$context['menu'] = $menu; // передаем меню в контекст
$context['submenu']=$submenu;
echo $twig->render($template, $context);
