<?php 
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_TIME, 'pt_BR.utf8', 'pt_BR', 'pt_BR.UTF-8', 'portuguese');

session_start();
 
define('APP_ROOT', dirname(__DIR__));

require_once APP_ROOT . '/vendor/autoload.php';
require_once APP_ROOT . '/core/web.php';
  