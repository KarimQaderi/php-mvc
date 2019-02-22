<?php

    function basePath($path = null)
    {
        return path .($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    function appPath($path = null)
    {
        return basePath('App'.($path ? DIRECTORY_SEPARATOR.$path : $path)) ;
    }

    function storagePath($path = null)
    {
        return basePath('storage' .($path ? DIRECTORY_SEPARATOR.$path : $path));
    }

    function configPath($file = null)
    {
        return basePath('Config/' . $file);
    }

    function dump($dump)
    {
        echo "<pre style='border-radius:2px;padding:5px;background-color: rgb(51, 51, 51);color: rgb(255, 255, 255);overflow: auto;'>";
        print_r($dump);
        echo "</pre>";
    }

    function dd($dd)
    {
        dump($dd);
        exit();
    }

    function asset($url , $echo = true)
    {
        $url = '/public/' . $url;

        if($echo == false)
            return $url;

        echo $url;
    }

    function slug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u' , '-' , $text);

        // transliterate
        $text = iconv('utf-8' , 'us-ascii//TRANSLIT' , $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~' , '' , $text);

        // trim
        $text = trim($text , '-');

        // remove duplicate -
        $text = preg_replace('~-+~' , '-' , $text);

        // lowercase
        $text = strtolower($text);

        if(empty($text)){
            return 'n-a';
        }

        return $text;
    }