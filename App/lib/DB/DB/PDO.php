<?php

    namespace App\lib\DB\DB;

    class PDO extends AbstractDB
    {
        use Relation;

        private $bindValue = [];

        public function all($column = '*')
        {
            $this->select($column);
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
            $this->where($this->table_Key , $find);
            $this->limit(1);

            return $this;
        }

        public function where($field , $value , $type = '=' , $betweenWhere = '&&')
        {
            /* @var \PDO $DB */
            global $DB;


            if(strpos($this->Where , ' where ') === false)
                $this->Where .= " where ";
            else
                $this->Where .= " $betweenWhere ";

            $this->Where .= $field . $type . ":{$field}_where";

            $this->bindValue = array_merge(
                $this->bindValue , [$field . '_where' => $value]
            );

            return $this;
        }

        public function limit($limit)
        {
            $this->Limit = " limit $limit";

            return $this;
        }

        public function get()
        {
            $this->select();

            /** @var \PDO $DB */
            global $DB;

            if(!$this->hasTable($this->getTable()))
                die("Not Found Table [{$this->getTable()}]");

//            dd($this->getQuery());

            return $this->BuildQuery($this->getQuery())->fetchAll();
        }


        public function first()
        {
            $this->select();

            /** @var \PDO $DB */
            global $DB;

            if(!$this->hasTable($this->getTable()))
                die("Not Found Table [{$this->getTable()}]");

            $this->limit(1);
//            dd($this->getQuery());

            return $this->BuildQuery($this->getQuery())->fetch();
        }


        public function hasTable($table)
        {
            /** @var \PDO $DB */
            global $DB;

            if(count($DB->query("show tables LIKE '{$table}'")->fetchAll()) == 0)
                return false;

            return true;
        }

        public function update(array $data)
        {

            $data_string = $this->ConverDataArray($data);

            return $this->BuildQuery("update {$this->getTable()} set " . $data_string . $this->Where . $this->Limit , $data);

        }

        public function delete($find = null)
        {
            if(!is_null($find))
                $this->where($this->table_Key , $find);

            return $this->BuildQuery("delete from {$this->getTable()} " . $this->Where . $this->Limit);

        }

        public function insert(array $data)
        {

            $column = null;
            $data_string = null;
            $i = 1;
            $add = ' , ';
            foreach($data as $key => $value){
                if(count($data) == $i) $add = '';
                $column .= $key . $add;
                $data_string .= ":$key $add";
                $i++;
            }

            return $this->BuildQuery("INSERT INTO {$this->getTable()} ($column) VALUES ($data_string)" , $data);


        }

        private function BuildQuery($query , $data = [])
        {
            /** @var \PDO $DB */
            global $DB;

            $stmt = $DB->prepare($query);

            $stmt->execute(
                array_merge(
                    $this->bindValue ,
                    $data
                )
            );

            if($stmt->errorCode() != "00000")
                dd(array_merge(
                    ['Line Code' => __LINE__] ,
                    $stmt->errorInfo()
                ));

            return $stmt;
        }

        private function ConverDataArray(array $data)
        {
            $data_string = null;
            $i = 1;
            $add = ' , ';
            foreach($data as $key => $value){
                if(count($data) == $i) $add = '';
                $data_string .= $key . "=:$key $add";
            }

            return $data_string;
        }

        private function getQuery()
        {
            return $this->Query . $this->Where . $this->getWith() . $this->Limit;
        }

    }