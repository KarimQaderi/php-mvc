<?php


    namespace App\lib\Session;


    interface interfaceSession
    {
        /**
         * add item
         *
         * @param $name
         * @param $content
         */
        public static function put($name , $content);

        /**
         * Get item
         *
         * @param $name
         * @return mixed
         */
        public static function get($name);

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

        /**
         * flash an item
         *
         * @param $name
         * @param $content
         */
        public static function flash($name , $content);

        /**
         * forget All Flash
         */
        public static function forgetAllFlash();

    }