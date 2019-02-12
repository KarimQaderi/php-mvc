<?php


    namespace App\inc;


    class Controller
    {
        function view($view , $data = [])
        {
            extract($data);
            require_once __DIR__ . '/../../view/' . $view . '.php';
        }


    }