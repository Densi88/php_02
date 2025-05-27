<?php
require_once "../framework/BaseController.php";
class SetHistoryController extends BaseController {
    public function get(array $context) {
         if (!isset($_SESSION['visit_history'])) {
            $_SESSION['visit_history'] = [];
        }
         $url=$_SERVER['HTTP_REFERER'];
         array_push($_SESSION['visit_history'], $url);
    }
}