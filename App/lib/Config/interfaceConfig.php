<?php


    namespace App\lib\Config;


    interface interfaceConfig
    {


        /**
         * Get item
         *
         * @param $key
         * @param $default
         * @return mixed
         */
        public static function get($key , $default = null);

        /**
         * check has item
         *
         * @param $key
         * @return bool
         */
        public static function has($key);


    }