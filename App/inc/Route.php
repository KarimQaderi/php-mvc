<?php


    namespace App\inc;


    class Route
    {
        private $routes = [] , $params , $controller , $method;

        function add($route , $controller , $method)
        {

            $this->routes[] = [
                'route' => $route ,
                'controller' => $controller ,
                'method' => $method ,
            ];
        }

        function run()
        {
            $url = $_SERVER['REQUEST_URI'];
            $mainUrl = $_SERVER['REQUEST_URI'];
            $pos = strpos($mainUrl , '?');
            if($pos !== false)
                $mainUrl = substr($_SERVER['REQUEST_URI'] , 0 , $pos);


            $params = explode('/' , $url);
            $params = array_filter($params);
            $this->params = $params;

            $routeFound = false;
            foreach($this->routes as $route){
                $this->controller = $route['controller'];
                $this->method = $route['method'];
                if($route['route'] == $mainUrl){
                    if($this->hasController()){
                        if($this->hasMethod())
                            (new $this->controller())->{$this->method}();
                    }
                    $routeFound = true;
                    break;
                }

            }

            if($routeFound == false) die("Not Found Page");

        }

        private function hasMethod()
        {
            if(method_exists(new $this->controller() , $this->method))
                return true;
            else
                die("Not Found Method [$this->method] in Controller [$this->controller]");

        }

        private function hasController()
        {
            if(class_exists($this->controller))
                return true;
            else
                die("Not Found Controller [$this->controller]");
        }

    }