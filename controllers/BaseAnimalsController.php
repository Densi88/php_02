<?php

    class BaseAnimalsController extends TwigBaseController{
        public function getContext():array{
            $context=parent::getContext();

            $query = $this->pdo->query("SELECT name FROM `type` ORDER BY 1");
             // стягиваем данные
            $types = $query->fetchAll();
            // создаем глобальную переменную в $twig, которая будет достпна из любого шаблона
            $context['types']=$types;
            return $context;
        }
    }