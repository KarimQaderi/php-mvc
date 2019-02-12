<?php

    use App\Controller\PostController;
    use App\inc\DB;
    use App\inc\Route;

    require 'vendor/autoload.php';

    global $DB;

    $DB = (new DB('localhost' , 'root' , '' , 'testPHP','PDO'))->connect();

//    dd($DB->query("select * from tb")->fetch_all(1));

    $route = new Route();

    $route->add('/' , PostController::class , 'index');
    $route->add('/post' , PostController::class , 'Post');

    $route->run();


?>

