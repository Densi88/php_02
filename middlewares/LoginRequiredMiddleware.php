<?php
require_once "../framework/BaseMidleware.php";
    class LoginRequiredMiddleware extends BaseMiddleware{
       public function apply(BaseController $controller, array $context)
        {
            
        // берем значения которые введет пользователь
            $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
            $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';

            $user_query = $controller->pdo->prepare("SELECT username FROM users WHERE username=:user");
            $user_query->bindValue("user", $user);
            $user_query->execute();
            $valid_user=$user_query->fetch(PDO::FETCH_COLUMN);
            if($valid_user==null){
                header('WWW-Authenticate: Basic realm="Space objects"');
                http_response_code(401);
                exit;
            }

            $password_query = $controller->pdo->prepare("SELECT password FROM users WHERE username=:user");
            $password_query->bindValue("user", $user);
            $password_query->execute();
            $valid_password=$password_query->fetch(PDO::FETCH_COLUMN);


            



        
        // сверяем с корректными
            if ($valid_user != $user || $valid_password != $password) {
                // если не совпали, надо указать такой заголовок
                // именно по нему браузер поймет что надо показать окно для ввода юзера/пароля
                header('WWW-Authenticate: Basic realm="Space objects"');
                http_response_code(401); // ну и статус 401 -- Unauthorized, то есть неавторизован
                exit; // прерываем выполнение скрипта
            } 
    }
    }