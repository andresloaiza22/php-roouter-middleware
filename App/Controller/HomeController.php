<?php
namespace App\Controller;

class HomeController extends Controller{
    function index(){
        return $this->views("Home.contacto",["titulo"=>"index"]);
    }
    function second(){
        echo "hola";
    }
    function about(){
        echo "about";
    }
    function eliminar(){
        session_destroy();
        echo "session eliminada ";
    }
    function creando(){
        $_SESSION["user"]="andres";
    }
    
}
?>