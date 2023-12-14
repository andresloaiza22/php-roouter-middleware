<?php
namespace App\Controller;
class Controller{
    
    function views($ruta,$data=[]){
        
        extract($data);
        




        
        $body;
        
        $ruta=str_replace(".","/",$ruta);
        //if(array_key_exists("header",$data )  || array_key_exists("footer",$data)){
        if(isset($header) || isset($footer)){    
            if($header){
                ob_start();
                require_once "../resources/views/Encabezados/header.php";
                $header=ob_get_clean();
            }

            if(isset($footer)){
                ob_start();
                require_once "../resources/views/Encabezados/footer.php";
                $footer=ob_get_clean();
            }
            
        }

        if(is_file("../resources/views/{$ruta}.php")){
            
            
            
            ob_start();
            require_once "../resources/views/{$ruta}.php";
            $body=ob_get_clean();
            
            
            
            include_once "../resources/views/plantilla.php";
            
        }
    }
    
}
?> 