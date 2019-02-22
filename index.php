<?php

    require 'vendor/autoload.php';

    define('path' , __DIR__);


    session_save_path(storagePath('session'));
    session_start();

    global $DB;

    $DB = (\App\lib\DB\DB::getInstance())->connect();

    // include router
    include_once basePath('routes/web.php');


    // forget All Flash Session
    \App\lib\Session\Session::forgetAllFlash();

?>

