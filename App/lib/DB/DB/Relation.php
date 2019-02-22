<?php


    namespace App\lib\DB\DB;


    trait Relation
    {
        public function belongsTo($related_table , $foreignKey , $ownerKey)
        {
            return " left join $related_table on {$this->getTable()}.$ownerKey = $related_table.$foreignKey ";
        }

    }