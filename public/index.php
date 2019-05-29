<?php
   // header("Content-Type: text/html; charset=utf-8");
    session_start();
    require_once "../Src/vendor/autoload.php";
    require_once '../Config/config.php';
   	
    use App\Dispatch;
    $controlador = new Dispatch();