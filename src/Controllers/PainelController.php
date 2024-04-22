<?php
namespace Blog\Faculdade\Controllers;
 
use Blog\Faculdade\Controllers\Controller;

class PainelController extends Controller
{
    public function index() {
         
        require_once APP_ROOT . '/src/Views/painel/index.php';
    }
}