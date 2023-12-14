<?php
use Lib\Route;
use App\Controller\HomeController;
Route::get("/",function(){
    return ["titulo"];
});
Route::get("/contacto/{nombre}",[HomeController::class,"index"])->middleware("guest");
Route::get("/somos",[HomeController::class,"second"])->middleware("guest");
Route::get("/eliminar",[HomeController::class,"eliminar"]);
Route::get("/about",[HomeController::class,"about"])->middleware("guest");
Route::get("/creando",[HomeController::class,"creando"]);

Route::dispath();
?>