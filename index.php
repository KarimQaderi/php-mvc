<?php

    use App\Controller\PostController;
    use App\inc\DB;
    use App\inc\Route;
    use App\lib\Config\Config;

    require 'vendor/autoload.php';

    define('path' , __DIR__);


    session_save_path(storagePath('session'));
    session_start();

    global $DB;

    $DB = (DB::getInstance())->connect();

    $route = new Route();

    $route->add('/' , PostController::class , 'index');
    $route->add('/add' , PostController::class , 'Add');
    $route->add('/post' , PostController::class , 'Post');

    $route->run();

    \App\lib\Session\Session::forgetAllFlash();

?>

