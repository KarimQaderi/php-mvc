<?php


    namespace App\lib\Router;


    class Route
    {
        private $routes = [] , $params , $controller , $method;

        function add($route , $controller)
        {
            $this->routes[] = array_merge($controller , ['route' => $route]);
        }

        function run()
        {

            $url = $_SERVER['REQUEST_URI'];
            $pos = strpos($url , '?');
            if($pos !== false)
                $url = substr($_SERVER['REQUEST_URI'] , 0 , $pos);


            $params = explode('/' , $url);
            $params = array_filter($params);
            $this->params = $params;

            $routeFound = false;
            foreach($this->routes as $route){
                $this->controller = $route['controller'];
                $this->method = $route['method'];
                $findRoute = $this->findRoute($route);
                if($findRoute['status']){
                    if($this->hasController()){
                        if($this->hasMethod()){
                            (new $this->controller())->{$this->method}(...$findRoute['params']);
                        }
                    }
                    $routeFound = true;
                    break;
                }

            }

            if($routeFound == false) die("Not Found Page");

        }

        private function findRoute($route)
        {

            $params = [];

            $route_params = explode('/' , $route['route']);
            $route_params = array_filter($route_params);

            $flag = 0;
            if(count($this->params) == count($route_params)){
                if(count($route_params) == 0){
                    return ['status' => true , 'params' => []];
                }

                for($i = 1; $i <= count($this->params); $i++){
                    if(!is_numeric(strpos($route_params[$i] , '{'))){
                        if($route_params[$i] != $this->params[$i])
                            $flag = 1;
                    } else
                        $params = array_merge($params , [$this->params[$i]]);

                    if(count($this->params) == $i && $flag == 0){
                        return ['status' => true , 'params' => $params];
                        break;
                    }

                }
            }

            return ['status' => false , 'params' => []];


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