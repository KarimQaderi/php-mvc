<?php
    namespace App\inc\DB;

    interface InterfaceDB
    {
        public function all($column = '*');

        public function select($column = '*');

        public function find($find);

        public function where($field , $value , $type = '=' , $betweenWhere = '&');

        public function limit($limit);

        public function get();

        public function hasTable($table);

    }