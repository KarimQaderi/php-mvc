<?php


    namespace App\inc;


    class Singleton
    {
        private static $getInstance;

        /**
         * @return $this
         */
        public static function getInstance()
        {
            if(self::$getInstance == null)
                self::$getInstance = new static();

            return self::$getInstance;
        }

    }