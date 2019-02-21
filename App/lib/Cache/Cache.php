<?php

    namespace App\lib\Cache;

    /**
     * Class Cache
     *
     * @method static CacheMain remember($name , $minutes , \Closure $function);
     * @method static CacheMain setDriver($driver);
     * @method static CacheMain add($name , $value , $minutes);
     * @method static CacheMain get($name);
     * @method static CacheMain forget($name);
     * @method static CacheMain has($name);
     * @method static CacheMain flush();
     */
    class Cache
    {

        public static function __callStatic($name , $arguments)
        {
            return (new CacheMain)->$name(...$arguments);
        }


    }