<?php 
date_default_timezone_set("America/Sao_Paulo");
session_start();
 
define('APP_ROOT', dirname(__DIR__));

require_once APP_ROOT . '/vendor/autoload.php';
require_once APP_ROOT . '/core/web.php';
  