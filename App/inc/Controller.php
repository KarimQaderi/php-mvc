<?php


    namespace App\inc;


    class Controller
    {
       public static function is($method)
        {
            return [
                'method' => $method ,
                'controller' => static::class
            ];
        }

        function view($view , $data = [])
        {
            extract($data);
            require_once __DIR__ . '/../../view/' . $view . '.php';
        }


    }