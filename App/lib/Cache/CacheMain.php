<?php


    namespace App\lib\Cache;




    use App\lib\Cache\Driver\File;
    use App\lib\Cache\Driver\Redis;

    class CacheMain implements interfaceCache
    {

        /** @var $driver interfaceCache */
        private $driver;

        public function __construct()
        {
            $this->setDriver('file');
        }


        /**
         * change driver for cache
         *
         * @param $driver "file","redis","database"
         * @return $this
         */
        public function setDriver($driver)
        {
            switch($driver){
                case 'file':
                    $this->driver = new File();
                    break;
                case 'redis':
                    $this->driver = new Redis();
                    break;
            }

            return $this;
        }

        /**
         * add item by function
         *
         * @param $name
         * @param $time
         * @param \Closure $function
         * @return mixed
         */
        public function remember($name , $minutes , \Closure $function)
        {
            return $this->driver->remember($name , $minutes , $function);
        }

        /**
         * add item by string
         *
         * @param $name
         * @param $value
         * @param $minutes
         * @return mixed
         */
        public function add($name , $value , $minutes)
        {
            return $this->driver->add($name,$value,$minutes);
        }


        /**
         * Get item
         *
         * @param $name
         * @return mixed
         */
        public function get($name)
        {
            return $this->driver->get($name);
        }

        /**
         * Remove Item
         *
         * @param $name
         */
        public function forget($name)
        {
            return $this->driver->forget($name);
        }

        /**
         * check has item
         *
         * @param $name
         * @return bool
         */
        public function has($name)
        {
            return $this->driver->has($name);
        }

        /**
         * Remove All item
         *
         */
        public function flush()
        {
            return $this->driver->flush();
        }
    }