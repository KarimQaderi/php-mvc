<?php

    namespace App\lib\DB\DB;

    abstract class AbstractDB implements InterfaceDB
    {
        protected $table;
        protected $table_Key = 'id';
        protected $Query;
        protected $Where;
        protected $Limit;
        private $with = [];

        public static function make()
        {
            return new static;
        }


        /**
         * add relation method
         *
         * @param array $with
         */
        public function with($with = [])
        {
            $this->with = $with;

            return $this;
        }

        /**
         * get relation method
         *
         * @return string
         */
        public function getWith()
        {
            $query = null;
            foreach($this->with as $item){
                if(method_exists($this,$item))
                    $query .= $this->{$item}();
            }

            return $query;
        }

        public function getTable()
        {
            $name = strtolower((new \ReflectionClass($this))->getShortName());
            return $this->table ? $this->table : $name . 's';
        }
    }