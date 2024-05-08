<?php
namespace Blog\Faculdade\Controllers;
  
class Controller
{
    public $title = "";
    public $message = "";
    public $footer = "";

    public function __construct()
    {
        $this->title = "Paper Blog";
        $this->message = "Noticias e tecnologia";
        $this->footer = "Paper UNIASSELVI -  Análise e Desenvolvimento de Sistemas (5016105)";
    } 
}