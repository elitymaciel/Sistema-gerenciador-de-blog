<?php
namespace Blog\Faculdade\Controllers;

use Blog\Faculdade\Models\Usuario;
use Blog\Faculdade\Controllers\Controller;

class HomeController extends Controller
{
   

    public function index() {
        
        /* $user = new Usuario();
        print_r($user->getUsuarioById(1)); */

        require_once APP_ROOT . '/src/Views/front/index.php';
    }
}