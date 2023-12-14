<?php
namespace Lib;
session_start();



use App\Controller\Controller;

class Route extends Controller{
    protected static $route;
    protected static $validandoCallback;
    
    static function get($url,$callback){
        
        
        $url=trim($url,"/");   
        self::$route["GET"][$url]=$callback;
        self::$validandoCallback=$callback;
            
        
        
        return new self();
    }   

    static function post($url,$callback){
        $url=trim($url,"/");   
        self::$route["POST"][$url]=$callback;
        self::$validandoCallback=$callback;
        return new self();

    }   

    public static function middleware($key){
        $method=$_SERVER["REQUEST_METHOD"];
        if(!is_callable(self::$validandoCallback)){
            if($method=="GET"){
                array_push(self::$route["GET"][array_key_last(self::$route["GET"])],["middleware"=>$key]);

            }else{
                array_push(self::$route["POST"][array_key_last(self::$route["POST"])],["middleware"=>$key]);
            }
            
            //self::$route["GET"][array_key_last(self::$route["GET"])][2]["middleware"]"
              
        }
        return new self();
        
    }
    static function dispath(){
        
        $uri=$_SERVER["REQUEST_URI"];
        $uri=trim($uri,"/"); 
        
        
        $method=$_SERVER["REQUEST_METHOD"];
        foreach(self::$route[$method] as $url => $callback){
            $url2=$url;
            if(strpos($url,"{")){
                $url=preg_replace("#{[a-zA-Z\d]+}#","([a-zA-Z\d]+)",$url);
                

            }
            if(preg_match("#^$url$#",$uri,$match)){
                $match=array_slice($match,1);
                
                if(is_callable($callback))
                {
                    $resultado=$callback($data=new Controller(),...$match);
                }
                if(is_array($callback)){
                    
                    if(isset(self::$route[$method][$url2][2]["middleware"]) ){
                        if(self::$route[$method][$url2][2]["middleware"]=="guest"){
                        
                        if(!isset($_SESSION["user"])){
                            echo "ff";    
                            header("Location: /");
                            exit();
                        }
                        }
                    }
                    
                    $resultado=new $callback[0];
                    $resultado->{$callback[1]}(...$match);
                    return;
                }
                
                if(is_array($resultado) || is_object($resultado)){
                    header('Content-Type: application/json');
                    echo json_encode($resultado); 
                    return;
                }   
                
                return;    
                
                
            }
            
            

        }
        echo "pagina no existe";
    }
    
}
?>