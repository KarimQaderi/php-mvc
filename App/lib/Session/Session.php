<?php


    namespace App\lib\Session;


    class Session implements interfaceSession
    {

        /**
         * add item
         *
         * @param $name
         * @param $content
         */
        public static function put($name , $content)
        {
            $_SESSION[$name] = $content;
        }

        /**
         * Get item
         *
         * @param $name
         * @return mixed
         */
        public static function get($name)
        {
            return $_SESSION[$name];
        }

        /**
         * Get All item
         *
         * @return mixed
         */
        public static function all()
        {
            return $_SESSION;
        }


        /**
         * Remove Item
         *
         * @param $name
         */
        public static function forget($name)
        {
            unset($_SESSION[$name]);
        }


        /**
         * check has item
         *
         * @param $name
         * @return bool
         */
        public static function has($name)
        {
            return isset($_SESSION[$name]) ? true : false;
        }

        /**
         * Remove All item
         *
         */
        public static function flush()
        {
            session_unset();
        }


        /**
         * flash an item
         *
         * @param $name
         * @param $content
         */
        public static function flash($name , $content)
        {
            static::put($name , $content);

            if(static::has('_flash') && is_array(static::get('_flash')))
                $old_flash = array_merge(static::get('_flash') , [$name]);
            else
                $old_flash = [$name];

            static::put('_flash' , $old_flash);
        }

        /**
         * forget All Flash
         */
        public static function forgetAllFlash()
        {
            if(static::has('_flash') && is_array(static::get('_flash')))
                foreach(static::get('_flash') as $flash)
                    static::forget($flash);

            static::forget('_flash');
        }

    }