<?php

    namespace App\inc;

    use App\lib\Config\Config;

    class DB extends Singleton
    {

        private $host , $username , $passwd , $dbname , $driver;


        function __construct()
        {
            $this->host = Config::get('Database.host');
            $this->username = Config::get('Database.username');
            $this->passwd = Config::get('Database.passwd');
            $this->dbname = Config::get('Database.dbname');
            $this->driver = Config::get('Database.driver');
        }

        /**
         * connect in database
         *
         * @return mixed
         */
        public function connect()
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