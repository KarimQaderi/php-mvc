<?php


    namespace App\lib\Cache;


    interface interfaceCache
    {
        /**
         * add item by function
         *
         * @param $name
         * @param $time
         * @param \Closure $function
         * @return mixed
         */
        public function remember($name , $time , \Closure $function);

        /**
         * add item by string
         *
         * @param $name
         * @param $value
         * @param $minutes
         * @return mixed
         */
        public function add($name , $value , $minutes);

        /**
         * Get item
         *
         * @param $name
         * @return mixed
         */
        public function get($name);


        /**
         * Remove Item
         *
         * @param $name
         */
        public function forget($name);

        /**
         * check has item
         *
         * @param $name
         * @return bool
         */
        public function has($name);

        /**
         * Remove All item
         *
         */
        public function flush();


    }