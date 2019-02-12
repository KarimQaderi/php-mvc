<?php

    namespace App\inc\DB;
    abstract class AbstractDB implements InterfaceDB
    {
        protected $table;
        protected $table_Key = 'id';
        protected $Query;
        protected $Where;
        protected $Limit;

        public static function make()
        {
            return new static;
        }

        public function getTable()
        {
            $name = strtolower((new \ReflectionClass($this))->getShortName());
            return $this->table ? $this->table : $name . 's';
        }
    }