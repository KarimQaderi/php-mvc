<?php


    namespace App\lib\Config;


    class Config implements interfaceConfig
    {


        /**
         * Get item
         *
         * @param $key
         * @param $default
         * @return mixed
         */
        public static function get($key , $default = null)
        {
            $data = static::getDataAndCheck($key);

            return ($data['status']) ? $data['content'] : $default;
        }


        /**
         * check has item
         *
         * @param $key
         * @return bool
         */
        public static function has($key)
        {
            return static::getDataAndCheck($key)['status'];
        }


        private static function getDataAndCheck($key)
        {
            $key = explode('.' , $key);

            if(!file_exists(configPath($key[0] . '.php')))
                return [
                    'status' => false ,
                    'content' => null
                ];

            $data = require configPath($key[0] . '.php');

            return [
                'status' => isset($key[1]) ? (isset($data[$key[1]]) ? true : false) : true ,
                'content' => isset($key[1]) ? (isset($data[$key[1]]) ? $data[$key[1]] : false) : $data
            ];
        }

    }