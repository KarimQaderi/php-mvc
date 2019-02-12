<?php

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