<?php


    use App\Controller\PostController;

    $route = new \App\lib\Router\Route();

    $route->add('/' , PostController::is('index'));
    $route->add('/add' , PostController::is('Add'));
    $route->add('/post' , PostController::is('Post'));
    $route->add('/post/{id}/shfow' , PostController::is( 'Showy'));
    $route->add('/post/{id}/show/' , PostController::is( 'Show'));
    $route->add('/post/{id}/shossw' , PostController::is( 'Shoyw'));

    $route->run();