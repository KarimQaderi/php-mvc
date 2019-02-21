<?php


    namespace App\lib\Cookie;


    interface interfaceCookie
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
        public static function put($name , $content , $minutes);

        /**
         * Get item
         *
         * @param $name
         * @param null $default
         * @return mixed
         */
        public static function get($name , $default = null);

        /**
         * Get All item
         *
         * @return mixed
         */
        public static function all();

        /**
         * Remove Item
         *
         * @param $name
         */
        public static function forget($name);

        /**
         * check has item
         *
         * @param $name
         * @return bool
         */
        public static function has($name);

        /**
         * Remove All item
         *
         */
        public static function flush();


    }