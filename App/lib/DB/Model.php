<?php

    namespace App\lib\DB;


    use App\lib\DB\DB\AbstractDB;

    class Model extends AbstractDB
    {
        protected $table;
        protected $table_Key = 'id';
        protected $Query;

        public function all($column = '*')
        {
            $this->select();
            return $this;
        }

        public function select($column = '*')
        {
            if(empty($this->Query))
                $this->Query = "select $column from {$this->getTable()} ";

            return $this;
        }

        public function find($find)
        {
            $this->select();
            $this->where($this->table_Key , $find);
            $this->limit(1);

            return $this;
        }

        public function where($field , $value , $type = '=' , $betweenWhere = '&')
        {
            $this->select();

            if(strpos($this->Query , ' where ') == null)
                $this->Query .= " where ";
            else
                $this->Query .= " $betweenWhere ";

            $this->Query .= $field . $type . "'$value'";

            return $this;
        }

        public function limit($limit)
        {
            $this->select();
            $this->Query .= "limit $limit";

            return $this;
        }

        public function get()
        {
            global $DB;

            if(!$this->hasTable($this->getTable()))
                die("Not Found Table [{$this->getTable()}]");

            $this->select();
//            dd($this->Query);

            return $DB->query($this->Query)->fetch_all(1);
        }

        public function hasTable($table)
        {
            global $DB;

            if(count($DB->query("show tables LIKE '{$table}'")->fetch_all()) == 0)
                return false;

            return true;
        }


    }