<?php


    namespace App\lib\Cookie;


    class Cookie implements interfaceCookie
    {

        /**
         * add item
         *
         * @param $name
         * @param $content
         * @param $minutes
         *
         * @return mixed
         */
        public static function put($name , $content , $minutes)
        {
            setcookie($name , $content ,  time() + (60 * $minutes));

            return $content;
        }

        /**
         * Get item
         *
         * @param $name
         * @param null $default
         * @return mixed
         */
        public static function get($name , $default = null)
        {
            return isset($_COOKIE[$name])? $_COOKIE[$name] : $default;
        }

        /**
         * Get All item
         *
         * @return mixed
         */
        public static function all()
        {
            return $_COOKIE;
        }


        /**
         * Remove Item
         *
         * @param $name
         */
        public static function forget($name)
        {
            setcookie($name,null,0);
        }


        /**
         * check has item
         *
         * @param $name
         * @return bool
         */
        public static function has($name)
        {
            return isset($_COOKIE[$name]) ? true : false;
        }

        /**
         * Remove All item
         *
         */
        public static function flush()
        {
            foreach($_COOKIE as $key => $value)
                static::forget($key);
        }

    }