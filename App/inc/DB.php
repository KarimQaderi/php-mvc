<?php

    namespace App\inc;

    class DB
    {

        private $host , $username , $passwd , $dbname , $driver;

        function __construct($host , $username , $passwd , $dbname , $driver = 'PDO')
        {
            $this->host = $host;
            $this->username = $username;
            $this->passwd = $passwd;
            $this->dbname = $dbname;
            $this->driver = $driver;
        }

        /**
         * connect in database
         *
         * @return mixed
         */
        function connect()
        {
            switch($this->driver){
                case 'mysqli':
                    $DB = mysqli_connect($this->host , $this->username , $this->passwd , $this->dbname);
                    if($DB->errno)
                        die($DB->error);

                    $DB->set_charset('utf8');
                    break;
                case 'PDO';
                    $DB = new \PDO("mysql:host={$this->host};dbname={$this->dbname}" , $this->username , $this
                        ->passwd);
                    $DB->exec("SET NAMES 'utf8';");

                    break;
            }


            return $DB;
        }

    }