<?php

    namespace App\lib\Cache\Driver;


    use App\lib\Cache\interfaceCache;

    class File implements interfaceCache
    {

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
            $data = $this->getDataAndChackTime($name);

            if($data['timeEnd'] == true)
                return $this->set($name , $minutes , $function);

            return $data['content'];
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
            $data = $this->getDataAndChackTime($name);

            if($data['timeEnd'] == true)
                return $this->set($name , $minutes , $value);

            return $data['content'];
        }

        private function set($name , $minutes , $content)
        {
            if(is_callable($content))
                $content = call_user_func($content);

            file_put_contents($this->getPath($name) , strtotime('+' . $minutes . ' minutes') . serialize($content));

            return $content;
        }


        /**
         * Get item
         *
         * @param $name
         * @return mixed
         */
        public function get($name)
        {
            $data = $this->getDataAndChackTime($name);

            return $data['content'];
        }


        /**
         * Get item and chack time for remove
         *
         * @param $name
         * @return mixed
         */
        private function getDataAndChackTime($name)
        {
            $srcFile = $this->getPath($name);

            // chack has file or return null
            if(!file_exists($srcFile))
                return [
                    'timeEnd' => true ,
                    'content' => null
                ];

            $file = file_get_contents($srcFile);
            $time = substr($file , 0 , 10);
            $content = substr($file , 10);

            // chack time Exp
            if(strtotime('now') >= $time){
                $this->forget($name);
                return [
                    'timeEnd' => true ,
                    'content' => null
                ];
            }

            return [
                'timeEnd' => false ,
                'content' => unserialize($content) ,
            ];

        }


        private function getPath($name)
        {
            return storagePath('cache/'.slug($name));
        }

        /**
         * Remove Item
         *
         * @param $name
         */
        public function forget($name)
        {
            unlink($this->getPath($name));
        }

        /**
         * check has item
         *
         * @param $name
         * @return bool
         */
        public function has($name)
        {
            return file_exists($this->getPath($name)) ? true : false;
        }

        /**
         * Remove All item
         *
         */
        public function flush()
        {
            // TODO: Implement flush() method.
        }
    }