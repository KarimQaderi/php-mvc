<?php

    namespace App\lib\Cache\Driver;


    use App\lib\Cache\interfaceCache;

    class Redis implements interfaceCache
    {

        public function remember($name , $minutes , \Closure $function)
        {
           $this->set($name,$minutes,$function());

            return $function();
        }

        private function set($name ,$minutes, $content  )
        {
            file_put_contents(storagePath($this->getSlugName($name)) , strtotime('+' . $minutes . ' minutes') . serialize($content));
        }

        /**
         * Get item
         *
         * @param $name
         * @return mixed
         */
        public function get($name)
        {
            $file = file_get_contents(storagePath($this->getSlugName($name)));
            $time = substr($file , 0 , 10);
            $content = substr($file , 10);

            return [
                'time' => $time ,
                'content' => unserialize($content)
            ];
        }

        private function getSlugName($name)
        {
            return slug($name);
        }

        /**
         * Remove Item
         *
         * @param $name
         */
        public function forget($name)
        {
            unlink(storagePath($this->getSlugName($name)));
        }

        /**
         * check has item
         *
         * @param $name
         * @return bool
         */
        public function has($name)
        {
            return file_exists($this->getSlugName($name)) ? true : false;
        }

        /**
         * Remove All item
         *
         */
        public function flush()
        {
            // TODO: Implement flush() method.
        }

        /**
         * add item by string
         *
         * @param $name
         * @param $content
         */
        public function add($name , $value , $minutes)
        {
            // TODO: Implement add() method.
        }
    }